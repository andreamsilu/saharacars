<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminCarController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PageController;
use App\Models\Car;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return redirect()->route('home', ['locale' => config('app.locale')]);
});

/**
 * Classic favicon path crawlers hit first.
 * Serve a square PNG mark for consistent rendering in SERP/tab icons.
 */
Route::get('/favicon.ico', function () {
    $faviconPng = public_path('images/favicon-48.png');
    if (! is_file($faviconPng)) {
        abort(404);
    }

    return Response::file($faviconPng, [
        'Content-Type' => 'image/png',
        'Cache-Control' => 'public, max-age=604800',
    ]);
});

Route::get('/robots.txt', function () {
    $sitemapUrl = url('/sitemap.xml');
    $content = implode("\n", [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin',
        'Disallow: /saved',
        'Sitemap: '.$sitemapUrl,
        '',
    ]);

    return Response::make($content, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
});

Route::get('/sitemap.xml', function () {
    $locales = config('app.supported_locales', [config('app.locale')]);
    $now = now()->toAtomString();

    $urls = [];
    foreach ($locales as $locale) {
        $urls[] = ['loc' => route('home', ['locale' => $locale]), 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '1.0'];
        $urls[] = ['loc' => route('cars.index', ['locale' => $locale]), 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '0.9'];
        $urls[] = ['loc' => route('cars.bento', ['locale' => $locale]), 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '0.8'];
        $urls[] = ['loc' => route('why.choose.us', ['locale' => $locale]), 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.6'];
        $urls[] = ['loc' => route('contact', ['locale' => $locale]), 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.6'];
        $urls[] = ['loc' => route('order.request', ['locale' => $locale]), 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.6'];
    }

    $publishedCars = Car::query()
        ->where('is_published', true)
        ->select(['id', 'updated_at'])
        ->orderByDesc('updated_at')
        ->get();

    foreach ($publishedCars as $car) {
        $urls[] = [
            'loc' => $car->publicShowUrl(),
            'lastmod' => optional($car->updated_at)->toAtomString() ?? $now,
            'changefreq' => 'weekly',
            'priority' => '0.7',
        ];
    }

    $xml = view('sitemap', ['urls' => $urls])->render();

    return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
});

/** Unprefixed legacy URLs → default locale (bookmarks before i18n). */
$fallbackLocale = (string) config('app.locale');
Route::redirect('/cars/bento', '/'.$fallbackLocale.'/cars/bento', 301);
Route::redirect('/cars', '/'.$fallbackLocale.'/cars', 301);

/** Public inventory detail — no locale prefix; published-only in {@see CarController::show}. */
Route::middleware(['default_locale'])
    ->get('/cars/{car}', [CarController::class, 'show'])
    ->where('car', '^[A-Za-z0-9][A-Za-z0-9_-]*$')
    ->name('cars.show');
Route::redirect('/contact', '/'.$fallbackLocale.'/contact', 301);
Route::redirect('/saved', '/'.$fallbackLocale.'/saved', 301);
Route::redirect('/why-choose-us', '/'.$fallbackLocale.'/why-choose-us', 301);
Route::redirect('/order-request', '/'.$fallbackLocale.'/order-request', 301);
Route::redirect('/about', '/'.$fallbackLocale.'/why-choose-us', 301);

Route::prefix('{locale}')
    ->where(['locale' => implode('|', config('app.supported_locales', ['en', 'sw']))])
    ->middleware(['locale'])
    ->group(function () {
        Route::get('/', [PageController::class, 'home'])->name('home');

        Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
        Route::get('/cars/bento', [CarController::class, 'bento'])->name('cars.bento');
        // Legacy: /{locale}/cars/… → canonical /cars/…
        Route::get('/cars/{car}', function (string $locale, string $car) {
            return redirect()->to(url('/cars/'.$car), 301);
        })->where('car', '^[A-Za-z0-9][A-Za-z0-9_-]*$');

        Route::get('/why-choose-us', [PageController::class, 'whyChooseUs'])->name('why.choose.us');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::post('/contact', [InquiryController::class, 'store'])->name('contact.store');
        Route::get('/order-request', [PageController::class, 'orderRequest'])->name('order.request');
        Route::post('/order-request', [InquiryController::class, 'storeOrderRequest'])->name('order.request.store');
        Route::get('/saved', [PageController::class, 'saved'])->name('saved');

        Route::permanentRedirect('about', 'why-choose-us');
    });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

    Route::get('/', [AdminDashboardController::class, 'index'])
        ->middleware('admin')
        ->name('dashboard');

    Route::middleware('admin')->group(function () {
        Route::get('/cars', [AdminCarController::class, 'index'])->name('cars.index');
        Route::get('/cars/data/table', [AdminCarController::class, 'data'])->name('cars.data');
        Route::get('/cars/create', [AdminCarController::class, 'create'])->name('cars.create');
        Route::post('/cars', [AdminCarController::class, 'store'])->name('cars.store');
        Route::get('/cars/{car}', [AdminCarController::class, 'show'])->name('cars.show');
        Route::get('/cars/{car}/edit', [AdminCarController::class, 'edit'])->name('cars.edit');
        Route::put('/cars/{car}', [AdminCarController::class, 'update'])->name('cars.update');
        Route::delete('/cars/{car}', [AdminCarController::class, 'destroy'])->name('cars.destroy');

        Route::get('/brands', [AdminBrandController::class, 'index'])->name('brands.index');
        Route::post('/brands', [AdminBrandController::class, 'store'])->name('brands.store');
        Route::put('/brands/{brand}', [AdminBrandController::class, 'update'])->name('brands.update');
        Route::delete('/brands/{brand}', [AdminBrandController::class, 'destroy'])->name('brands.destroy');

        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
        Route::get('/order-requests', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::patch('/order-requests/{inquiry}/read', [AdminInquiryController::class, 'markRead'])->name('inquiries.read');

        Route::get('/announcements', [AdminAnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/create', [AdminAnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/announcements/{announcement}/edit', [AdminAnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('/announcements/{announcement}', [AdminAnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [AdminAnnouncementController::class, 'destroy'])->name('announcements.destroy');
    });
});
