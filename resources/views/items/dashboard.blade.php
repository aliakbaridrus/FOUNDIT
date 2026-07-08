@extends('layouts.app')

@section('title', 'Dashboard – FoundIt')

@section('content')

<div class="max-w-[1200px] mx-auto px-6 py-10">

    <div class="mb-10">
        <span class="text-xs font-semibold text-brand uppercase tracking-wider">Dashboard</span>
        <h1 class="font-heading font-bold text-4xl mt-2">My Items</h1>
        <p class="text-txt-secondary mt-2">Manage your lost and found posts</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                    <i data-lucide="package" class="w-7 h-7 text-brand"></i>
                </div>
                <div>
                    <p class="text-sm text-txt-secondary">Total Posts</p>
                    <h2 class="text-3xl font-bold">{{ $total }}</h2>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">
                    <i data-lucide="alert-circle" class="w-7 h-7 text-red-500"></i>
                </div>
                <div>
                    <p class="text-sm text-txt-secondary">Lost Items</p>
                    <h2 class="text-3xl font-bold">{{ $lost }}</h2>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-7 h-7 text-green-500"></i>
                </div>
                <div>
                    <p class="text-sm text-txt-secondary">Found Items</p>
                    <h2 class="text-3xl font-bold">{{ $found }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="flex flex-wrap gap-4 mb-8">
        <button onclick="filterItems('all')" class="px-5 py-2 rounded-xl bg-brand text-white font-medium">All</button>
        <button onclick="filterItems('Lost')" class="px-5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 transition">Lost</button>
        <button onclick="filterItems('Found')" class="px-5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 transition">Found</button>
    </div>

    <div class="space-y-6">

        @forelse ($items as $item)

            <div class="dashboard-item block bg-white rounded-3xl border border-slate-100 p-5 hover:shadow-lg transition-all duration-300"
                 data-status="{{ $item->status }}">

                <div class="flex flex-col md:flex-row gap-6">

                    <a href="{{ route('items.show', $item) }}">
                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image) }}"
                             alt="{{ $item->title }}"
                             class="w-full md:w-56 h-44 object-cover rounded-2xl">
                    </a>

                    <div class="flex-1">

                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 rounded-full bg-blue-100 text-brand text-xs font-bold">{{ $item->category }}</span>
                            <span class="text-sm text-txt-secondary">{{ $item->status }}</span>
                        </div>

                        <h2 class="text-2xl font-bold mb-3">{{ $item->title }}</h2>

                        <p class="text-txt-secondary mb-4 line-clamp-2">{{ $item->description }}</p>

                        <div class="flex items-center justify-between mt-4">

                            <div class="flex items-center gap-2 text-sm text-txt-secondary">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                {{ $item->location }}
                            </div>

                            <div class="flex items-center gap-3">
                                <a href="{{ route('items.show', $item) }}"
                                   class="px-4 py-2 rounded-xl bg-brand hover:bg-blue-700 text-white text-sm font-medium transition">
                                    View
                                </a>

                                <form action="{{ route('items.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-4 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white text-sm font-medium transition">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-3xl border border-slate-100 p-14 text-center">
                <div class="w-20 h-20 mx-auto rounded-3xl bg-blue-50 flex items-center justify-center mb-5">
                    <i data-lucide="inbox" class="w-10 h-10 text-brand"></i>
                </div>
                <h2 class="text-2xl font-bold mb-2">No Items Yet</h2>
                <p class="text-txt-secondary mb-6">Start posting your lost or found items now.</p>
                <a href="{{ route('items.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand text-white font-semibold hover:bg-blue-700 transition">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Post Item
                </a>
            </div>

        @endforelse

    </div>

</div>

@push('scripts')
<script>
    function filterItems(status) {
        document.querySelectorAll('.dashboard-item').forEach(item => {
            item.style.display = (status === 'all' || item.dataset.status === status) ? 'block' : 'none';
        });
    }
</script>
@endpush

@endsection
