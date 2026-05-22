@extends('admin.layout')

@section('title', 'Add Car')
@section('breadcrumb', 'Sahara Autolink / Inventory / Add')

@section('content')
    <div class="flex items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black tracking-tight">Add car</h1>
            <p class="text-sm text-on-surface-variant mt-2">Create a new listing.</p>
        </div>
        <a href="{{ route('admin.cars.index') }}" class="inline-flex min-h-[44px] items-center justify-center gap-1.5 rounded-xl border border-slate-200/80 bg-white px-4 py-2 text-sm font-semibold text-primary hover:bg-slate-50" title="Back to inventory">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_back</span>
            <span>Back</span>
        </a>
    </div>

    <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data" class="admin-car-form space-y-6">
        @include('admin.cars._form')

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" class="inline-flex min-h-[44px] items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3 text-sm font-bold text-on-primary shadow-sm hover:opacity-95 transition border border-primary/20">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">add_circle</span>
                <span>Create listing</span>
            </button>
        </div>
    </form>
@endsection

