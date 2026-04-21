<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminInquiryController extends Controller
{
    public function index(): View
    {
        $orders = Inquiry::query()
            ->where('inquiry_type', 'order_request')
            ->latest()
            ->paginate(20);

        return view('admin.inquiries.index', compact('orders'));
    }

    public function markRead(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->update(['read_at' => now()]);

        return back()->with('status', 'Order marked as read.');
    }
}

