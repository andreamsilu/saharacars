<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $statusFilter = (string) $request->query('status', 'all');
        if (! in_array($statusFilter, ['all', Inquiry::STATUS_PENDING, Inquiry::STATUS_DONE], true)) {
            $statusFilter = 'all';
        }

        $ordersQuery = Inquiry::query()
            ->where('inquiry_type', 'order_request')
            ->latest();

        if ($statusFilter !== 'all') {
            $ordersQuery->where('status', $statusFilter);
        }

        $orders = $ordersQuery->paginate(20)->withQueryString();

        $statusCounts = [
            'all' => Inquiry::query()->where('inquiry_type', 'order_request')->count(),
            Inquiry::STATUS_PENDING => Inquiry::query()
                ->where('inquiry_type', 'order_request')
                ->where('status', Inquiry::STATUS_PENDING)
                ->count(),
            Inquiry::STATUS_DONE => Inquiry::query()
                ->where('inquiry_type', 'order_request')
                ->where('status', Inquiry::STATUS_DONE)
                ->count(),
        ];

        return view('admin.inquiries.index', compact('orders', 'statusFilter', 'statusCounts'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry): RedirectResponse
    {
        if ($inquiry->inquiry_type !== 'order_request') {
            abort(404);
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in([Inquiry::STATUS_PENDING, Inquiry::STATUS_DONE])],
        ]);

        $status = $validated['status'];
        $inquiry->update([
            'status' => $status,
            'read_at' => $status === Inquiry::STATUS_DONE ? ($inquiry->read_at ?? now()) : null,
        ]);

        $message = $status === Inquiry::STATUS_DONE
            ? 'Order marked as done.'
            : 'Order marked as pending.';

        return back()->with('status', $message);
    }
}
