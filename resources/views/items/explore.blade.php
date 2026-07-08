@extends('layouts.app')

@section('title', 'Explore Items – FoundIt')

@section('content')

<div class="max-w-[1200px] mx-auto w-full px-6 py-12">

    <div class="mb-12">

        <span class="text-xs font-semibold text-brand uppercase tracking-wider">Discover</span>
        <h1 class="font-heading font-bold text-4xl mt-2 mb-6">Explore Items</h1>

        <form method="GET" action="{{ route('items.explore') }}" class="flex flex-col md:flex-row gap-4">

            <div class="flex-1 relative">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search items..."
                       class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
            </div>

            <select name="category" onchange="this.form.submit()"
                    class="px-6 py-4 rounded-2xl border border-slate-200 bg-white focus:outline-none">
                <option value="">All Categories</option>
                @foreach (['Electronics', 'Accessories', 'Documents', 'Pets', 'Keys', 'Other'] as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>

            <button type="submit" class="hidden md:block px-6 py-4 rounded-2xl bg-brand text-white font-medium">Search</button>

        </form>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @forelse ($items as $item)
            <a href="{{ route('items.show', $item) }}"
               class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 block">

                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image) }}"
                     alt="{{ $item->title }}"
                     class="w-full h-56 object-cover">

                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-blue-100 text-brand">{{ $item->category }}</span>
                        <span class="text-xs text-slate-400">{{ $item->status }}</span>
                    </div>

                    <h2 class="font-bold text-lg mb-2 line-clamp-1">{{ $item->title }}</h2>

                    <p class="text-sm text-txt-secondary mb-3 line-clamp-2">{{ $item->description }}</p>

                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        {{ $item->location }}
                    </div>
                </div>

            </a>
        @empty
            <div class="col-span-full text-center py-16 text-txt-secondary">
                No items match your search.
            </div>
        @endforelse

    </div>

</div>

@endsection
