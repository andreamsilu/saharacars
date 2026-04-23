@extends('admin.layout')

@section('title', 'Edit announcement')
@section('breadcrumb', 'Cars Admin / Offers & news / Edit')

@section('content')
    <div class="rounded-3xl card-lift bg-surface text-on-surface shadow-xl ring-1 ring-slate-200/70 overflow-hidden">
        <div class="p-7 md:p-8 border-b border-outline-variant/20">
            <h1 class="text-2xl font-extrabold text-primary font-headline">Edit post</h1>
        </div>
        <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" class="p-7 md:p-8 space-y-6">
            @csrf
            @method('PUT')
            @include('admin.announcements._form', ['announcement' => $announcement])
            @if ($errors->any())
                <div class="rounded-xl border border-error/30 bg-error-container/30 p-3 text-sm text-error" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center justify-center min-h-[44px] rounded-full bg-primary text-on-primary font-bold text-sm px-6">Update</button>
                <a href="{{ route('admin.announcements.index') }}" class="inline-flex items-center justify-center min-h-[44px] rounded-full border border-outline-variant/40 font-bold text-sm px-6">Back</a>
            </div>
        </form>
    </div>
@endsection
