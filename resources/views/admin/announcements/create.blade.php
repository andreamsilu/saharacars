@extends('admin.layout')

@section('title', 'New announcement')
@section('breadcrumb', 'Sahara Autolink / Offers & news / New')

@section('content')
    <div class="rounded-3xl card-lift bg-surface text-on-surface shadow-xl ring-1 ring-slate-200/70 overflow-hidden">
        <div class="p-7 md:p-8 border-b border-outline-variant/20">
            <h1 class="text-2xl font-extrabold text-primary font-headline">New post</h1>
            <p class="text-on-surface-variant text-sm mt-1">Shown in the “Offers &amp; updates” strip on the public home page.</p>
        </div>
        <form method="POST" action="{{ route('admin.announcements.store') }}" class="p-7 md:p-8 space-y-6">
            @csrf
            @include('admin.announcements._form')
            @if ($errors->any())
                <div class="rounded-xl border border-error/30 bg-error-container/30 p-3 text-sm text-error" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex gap-3">
                <button type="submit" class="inline-flex items-center justify-center gap-2 min-h-[44px] rounded-full bg-primary text-on-primary font-bold text-sm px-6">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">save</span>
                    <span>Save post</span>
                </button>
                <a href="{{ route('admin.announcements.index') }}" class="inline-flex items-center justify-center min-h-[44px] rounded-full border border-outline-variant/40 font-bold text-sm px-6">Cancel</a>
            </div>
        </form>
    </div>
@endsection
