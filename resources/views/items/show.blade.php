@extends('layouts.app')

@section('title', $item->title.' – FoundIt')

@section('content')

<div class="max-w-[900px] mx-auto px-6 py-12">

    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm">

        <div class="relative">
            <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image) }}"
                 alt="{{ $item->title }}"
                 class="w-full h-[450px] object-cover">

            <span class="absolute top-6 right-6 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider
                {{ $item->status === 'Lost' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                {{ $item->status }}
            </span>
        </div>

        <div class="p-8 lg:p-12">

            <div class="flex flex-wrap items-center gap-3 mb-5">
                <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-medium">{{ $item->category }}</span>
                <span class="text-txt-secondary text-sm flex items-center gap-1.5">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    {{ $item->created_at->format('d M Y') }}
                </span>
            </div>

            <h1 class="font-heading font-bold text-4xl text-txt mb-3">{{ $item->title }}</h1>

            <p class="text-sm text-txt-secondary mb-6">
                Posted by <span class="font-semibold text-txt">{{ $item->user->first_name }}</span>
            </p>

            <div class="flex items-center gap-2 text-txt-secondary mb-8">
                <i data-lucide="map-pin" class="w-5 h-5 text-brand"></i>
                <span class="font-medium">{{ $item->location }}</span>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 mb-8">
                <h4 class="font-semibold mb-3 text-sm uppercase tracking-wider text-slate-400">Description</h4>
                <p class="text-txt-secondary leading-relaxed">{!! nl2br(e($item->description)) !!}</p>
            </div>

            @if ($waLink)
                <a href="{{ $waLink }}" target="_blank"
                   class="w-full bg-brand hover:bg-blue-700 transition py-4 rounded-2xl text-white font-bold flex items-center justify-center gap-2 shadow-lg shadow-brand/20">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                    Contact Owner
                </a>
            @else
                <div class="w-full bg-slate-200 py-4 rounded-2xl text-center text-slate-500 font-semibold">
                    Owner has no WhatsApp number
                </div>
            @endif

        </div>

    </div>

</div>

@endsection
