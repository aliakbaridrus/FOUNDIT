@extends('layouts.app')

@section('title', 'My Profile – FoundIt')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="bg-white rounded-3xl border p-8 h-fit">

            <div class="flex flex-col items-center text-center">

                <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                    <i data-lucide="user" class="w-12 h-12 text-blue-600"></i>
                </div>

                <h2 class="text-2xl font-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>

                <p class="text-slate-500 mt-1">{{ $user->email }}</p>

                <span class="mt-4 px-4 py-1 rounded-full bg-blue-100 text-blue-600 text-sm font-semibold">
                    {{ ucfirst($user->role) }}
                </span>

            </div>

            <div class="border-t mt-8 pt-6 space-y-4">

                <div>
                    <p class="text-sm text-slate-500">First Name</p>
                    <p class="font-semibold">{{ $user->first_name }}</p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Last Name</p>
                    <p class="font-semibold">{{ $user->last_name }}</p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Email</p>
                    <p class="font-semibold">{{ $user->email }}</p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">WhatsApp</p>
                    <p class="font-semibold">{{ $user->whatsapp ?? '-' }}</p>
                </div>

            </div>

        </div>

        <div class="lg:col-span-2">

            <div class="bg-white rounded-3xl border p-8">

                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold">My Items</h2>
                    <a href="{{ route('items.create') }}"
                       class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                        + Post Item
                    </a>
                </div>

                <div class="space-y-5">

                    @forelse ($items as $item)

                        <a href="{{ route('items.show', $item) }}"
                           class="block border rounded-3xl overflow-hidden hover:shadow-lg transition">

                            <div class="flex flex-col md:flex-row">

                                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image) }}"
                                     class="w-full md:w-56 h-48 object-cover">

                                <div class="p-6 flex-1">

                                    <div class="flex items-center justify-between mb-3">
                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs font-bold">{{ $item->category }}</span>
                                        <span class="text-sm text-slate-500">{{ $item->status }}</span>
                                    </div>

                                    <h3 class="text-2xl font-bold mb-2">{{ $item->title }}</h3>

                                    <p class="text-slate-500 mb-4">{{ $item->description }}</p>

                                    <div class="flex items-center gap-2 text-sm text-slate-500">
                                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                                        {{ $item->location }}
                                    </div>

                                </div>

                            </div>

                        </a>

                    @empty

                        <p class="text-slate-500 text-center py-10">You haven't posted any items yet.</p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
