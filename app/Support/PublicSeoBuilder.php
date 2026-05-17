<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Structured data and hreflang helpers for public pages.
 */
final class PublicSeoBuilder
{
    /**
     * @return list<array{hreflang: string, href: string}>
     */
    public static function hreflangAlternates(): array
    {
        $route = request()->route();
        if ($route === null || $route->getName() === null) {
            return [];
        }

        if (! array_key_exists('locale', $route->parameters())) {
            return [];
        }

        $supported = config('app.supported_locales', ['en', 'sw']);
        $alternates = [];

        foreach ($supported as $locale) {
            $alternates[] = [
                'hreflang' => str_replace('_', '-', $locale),
                'href' => LocaleUrls::alternative($locale),
            ];
        }

        $defaultLocale = (string) config('app.locale', 'en');
        $alternates[] = [
            'hreflang' => 'x-default',
            'href' => LocaleUrls::alternative($defaultLocale),
        ];

        return $alternates;
    }

    /**
     * Default Organization + WebSite graph (indexable public pages).
     *
     * @return array<string, mixed>
     */
    public static function defaultGraph(): array
    {
        $siteName = (string) config('sahara.legal_entity_name', config('app.name'));
        $siteUrl = rtrim((string) config('sahara.public_site_url', url('/')), '/');
        $orgId = $siteUrl.'#organization';
        $locale = str_replace('_', '-', app()->getLocale());
        $phoneDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone'));
        $phoneE164 = $phoneDigits !== '' ? '+'.$phoneDigits : null;
        $email = (string) config('sahara.support_email');
        $instagram = trim((string) config('sahara.instagram_url'));
        $logoUrl = asset('images/favicon-512.png');
        $searchUrl = route('cars.index', ['locale' => app()->getLocale()]).'?q={search_term_string}';

        $sameAs = array_values(array_filter([$instagram !== '' ? $instagram : null]));

        $organization = [
            '@id' => $orgId,
            '@type' => ['Organization', 'AutoDealer'],
            'name' => $siteName,
            'url' => $siteUrl,
            'logo' => ['@type' => 'ImageObject', 'url' => $logoUrl],
            'description' => __('public.meta.organization_description', ['company' => $siteName]),
            'areaServed' => [
                '@type' => 'City',
                'name' => 'Dar es Salaam',
                'containedInPlace' => ['@type' => 'Country', 'name' => 'Tanzania'],
            ],
            'knowsAbout' => [
                __('public.home.service_sales_title'),
                __('public.home.service_rental_title'),
                __('public.home.service_import_title'),
            ],
        ];

        if ($phoneE164 !== null) {
            $organization['telephone'] = $phoneE164;
        }
        if ($email !== '') {
            $organization['email'] = $email;
        }
        if ($sameAs !== []) {
            $organization['sameAs'] = $sameAs;
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => $siteUrl.'#website',
                    'name' => $siteName,
                    'url' => $siteUrl,
                    'inLanguage' => $locale,
                    'publisher' => ['@id' => $orgId],
                    'potentialAction' => [
                        '@type' => 'SearchAction',
                        'target' => [
                            '@type' => 'EntryPoint',
                            'urlTemplate' => $searchUrl,
                        ],
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
                $organization,
            ],
        ];
    }

    /**
     * @param  array<string, mixed>  $productSchema
     * @return array<string, mixed>
     */
    public static function graphWithProduct(array $productSchema): array
    {
        $graph = self::defaultGraph();
        $graph['@graph'][] = $productSchema;

        return $graph;
    }
}
