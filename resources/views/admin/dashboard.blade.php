@extends('layouts.app')

@section('title', 'Admin Dashboard – FoundIt')

@section('content')

<div class="max-w-[1200px] mx-auto px-6 py-10">

    <div class="mb-8">
        <h1 class="font-heading font-bold text-4xl mb-2">Admin Dashboard</h1>
        <p class="text-txt-secondary">Manage all lost & found items</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-2xl border border-slate-100 p-6">
            <p class="text-sm text-slate-500 mb-2">Total Items</p>
            <h2 class="text-3xl font-bold">{{ $total }}</h2>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-6">
            <p class="text-sm text-slate-500 mb-2">Lost Items</p>
            <h2 class="text-3xl font-bold text-red-500">{{ $lost }}</h2>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-6">
            <p class="text-sm text-slate-500 mb-2">Found Items</p>
            <h2 class="text-3xl font-bold text-green-500">{{ $found }}</h2>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-6">
            <p class="text-sm text-slate-500 mb-2">Returned</p>
            <h2 class="text-3xl font-bold text-purple-500">{{ $returned }}</h2>
        </div>

    </div>

    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm">Image</th>
                        <th class="px-6 py-4 text-left text-sm">Title</th>
                        <th class="px-6 py-4 text-left text-sm">Posted By</th>
                        <th class="px-6 py-4 text-left text-sm">Category</th>
                        <th class="px-6 py-4 text-left text-sm">Location</th>
                        <th class="px-6 py-4 text-left text-sm">Status</th>
                        <th class="px-6 py-4 text-left text-sm">Action</th>
                    </tr>
                </thead>

                <tbody>

                @foreach ($items as $item)

                    <tr class="border-t">

                        <td class="px-6 py-4">
                            <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image) }}"
                                 alt="{{ $item->title }}"
                                 class="w-20 h-20 rounded-xl object-cover">
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-bold">{{ $item->title }}</div>
                            <div class="text-sm text-slate-500">{{ $item->description }}</div>
                        </td>

                        <td class="px-6 py-4">{{ $item->user->first_name }} {{ $item->user->last_name }}</td>

                        <td class="px-6 py-4">{{ $item->category }}</td>

                        <td class="px-6 py-4">{{ $item->location }}</td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                @if ($item->status === 'Lost') bg-red-100 text-red-600
                                @elseif ($item->status === 'Found') bg-green-100 text-green-600
                                @else bg-purple-100 text-purple-600
                                @endif">
                                {{ $item->status }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <form action="{{ route('admin.items.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
