@extends('layouts.app')

@section('title', 'FoundIt - Smart Lost & Found')

@section('content')

<section class="hero-gradient">

    <div class="max-w-[1200px] mx-auto px-6 py-16 lg:py-24 flex flex-col lg:flex-row items-center gap-12">

        <div class="flex-1">

            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white rounded-full shadow-sm text-xs font-medium text-brand mb-6">
                <span class="w-2 h-2 bg-accent rounded-full"></span>
                Trusted by community
            </div>

            <h1 class="font-heading font-800 text-4xl lg:text-5xl xl:text-[56px] leading-tight text-txt mb-5">
                Lost Something?<br>
                We Help You
                <span class="text-brand">Find It.</span>
            </h1>

            <p class="text-txt-secondary text-lg max-w-lg mb-8">
                Connect with your community to recover lost belongings quickly and safely.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('items.create') }}"
                   class="btn-primary px-7 py-3.5 text-white font-semibold rounded-xl flex items-center gap-2">
                    <i data-lucide="search" class="w-5 h-5"></i>
                    Report Lost
                </a>

                <a href="{{ route('items.create') }}"
                   class="btn-accent px-7 py-3.5 text-white font-semibold rounded-xl flex items-center gap-2">
                    <i data-lucide="package-check" class="w-5 h-5"></i>
                    Report Found
                </a>
            </div>

        </div>

        <div class="flex-1 flex justify-center">
            <div class="w-80 h-80 lg:w-96 lg:h-96 rounded-3xl bg-gradient-to-br from-blue-100 to-green-50 flex items-center justify-center shadow-inner">
                <i data-lucide="search" class="w-32 h-32 text-brand opacity-20"></i>
            </div>
        </div>

    </div>

</section>

<section class="max-w-[1200px] mx-auto px-6 py-16">

    <div class="flex items-end justify-between mb-8">
        <div>
            <span class="text-xs font-semibold text-brand uppercase tracking-wider">Browse</span>
            <h2 class="font-heading font-bold text-3xl text-txt mt-1">Recent Items</h2>
        </div>

        <a href="{{ route('items.explore') }}"
           class="text-sm font-medium text-brand hover:text-brand-dark flex items-center gap-1">
            View all
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @foreach ($items as $item)
            <a href="{{ route('items.show', $item) }}"
               class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 block">

                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image) }}"
                     alt="{{ $item->title }}"
                     class="w-full h-56 object-cover">

                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-blue-100 text-brand">
                            {{ $item->category }}
                        </span>
                        <span class="text-xs text-slate-400">{{ $item->status }}</span>
                    </div>

                    <h3 class="font-bold text-lg mb-2">{{ $item->title }}</h3>

                    <p class="text-sm text-txt-secondary mb-3 line-clamp-2">{{ $item->description }}</p>

                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        {{ $item->location }}
                    </div>
                </div>

            </a>
        @endforeach

    </div>

</section>

@endsection
