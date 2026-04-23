<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAnnouncementRequest;
use App\Http\Requests\Admin\UpdateAnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminAnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::query()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        return view('admin.announcements.create');
    }

    public function store(StoreAnnouncementRequest $request): RedirectResponse
    {
        $data = $this->normalizedPayload($request->validated(), $request);

        Announcement::query()->create($data);

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement created.');
    }

    public function edit(Announcement $announcement): View
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(UpdateAnnouncementRequest $request, Announcement $announcement): RedirectResponse
    {
        $data = $this->normalizedPayload($request->validated(), $request);
        $announcement->update($data);

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement removed.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function normalizedPayload(array $data, Request $request): array
    {
        $data['is_published'] = (bool) ($request->boolean('is_published'));
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['link_url'] = isset($data['link_url']) && trim((string) $data['link_url']) !== ''
            ? trim((string) $data['link_url'])
            : null;
        $data['summary'] = isset($data['summary']) && trim((string) $data['summary']) !== ''
            ? trim((string) $data['summary'])
            : null;
        if (empty($data['starts_at'])) {
            $data['starts_at'] = null;
        }
        if (empty($data['ends_at'])) {
            $data['ends_at'] = null;
        }
        $data['link_new_tab'] = (bool) ($request->boolean('link_new_tab'));

        return $data;
    }
}
