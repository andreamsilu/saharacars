@extends('admin.layout')

@section('title', 'Add Car')
@section('breadcrumb', 'Sahara Autolink / Inventory / Add')

@section('content')
    <div class="flex items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black tracking-tight">Add car</h1>
            <p class="text-sm text-on-surface-variant mt-2">Create a new listing.</p>
        </div>
        <a href="{{ route('admin.cars.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-surface-container-low hover:bg-surface-container-high border border-slate-200/80 text-primary" title="Back to inventory" aria-label="Back to inventory">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span class="sr-only">Back</span>
        </a>
    </div>

    <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data" class="space-y-6">
        @include('admin.cars._form')

        <div class="flex items-center justify-end gap-3">
            <button type="submit" class="rounded-2xl bg-primary text-on-primary font-bold px-4 py-3.5 hover:opacity-95 transition inline-flex items-center justify-center border border-primary/20" title="Create listing" aria-label="Create listing">
                <span class="material-symbols-outlined text-[20px]">check</span>
                <span class="sr-only">Create</span>
            </button>
        </div>
    </form>
@endsection

