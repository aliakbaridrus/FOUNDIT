@extends('layouts.app')

@section('title', 'Login – FoundIt')

@section('content')

<div class="flex items-center justify-center p-6 py-16">

    <div class="w-full max-w-[400px] anim-fade-up">

        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 font-heading font-bold text-2xl mb-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand to-blue-400 flex items-center justify-center">
                    <i data-lucide="compass" class="w-6 h-6 text-white"></i>
                </div>
                <span>Found<span class="text-brand">It</span></span>
            </a>
            <p class="text-txt-secondary text-sm">Welcome back! Please enter your details.</p>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <p class="text-red-700 text-sm font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                           placeholder="name@company.com" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5">Password</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                           placeholder="••••••••" required>
                </div>

                <button type="submit"
                        class="w-full btn-primary py-3.5 text-white font-bold rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    Sign In
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-txt-secondary">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-brand font-bold hover:underline">Sign up for free</a>
                </p>
            </div>

        </div>

        <footer class="mt-6 rounded-3xl bg-brand text-white shadow-lg shadow-brand/20 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-white/15">
                <div class="p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70 mb-3">Nama Anggota</p>
                    <ol class="space-y-1.5 text-sm text-white/95 leading-relaxed">
                        <li>1. Muhammad Ali Akbar - 2024080128</li>
                        <li>2. Thoriq Ziyad Rohman - 2024080139</li>
                        <li>3. William - 20240801372</li>
                    </ol>
                </div>

                <div class="p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70 mb-3">Mata Kuliah</p>
                    <p class="text-sm text-white/95">Pemrograman Web</p>

                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70 mt-5 mb-3">Dosen Pengampu</p>
                    <p class="text-sm text-white/95 leading-relaxed">Devi Setiawati, A.Md., S.Pd., M.T.Kom</p>
                </div>

                <div class="p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70 mb-3">Kelas</p>
                    <p class="text-sm text-white/95 mb-4">KH002</p>

                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70 mb-3">Domain</p>
                    <p class="text-sm text-white/95 mb-4">www.foundit.web.id</p>

                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70 mb-3">Tahun Akademik</p>
                    <p class="text-sm text-white/95">2025/2026 Genap</p>
                </div>
            </div>
        </footer>

        <a href="{{ route('home') }}"
           class="flex items-center justify-center gap-2 mt-8 text-sm text-txt-secondary hover:text-brand transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Home
        </a>

    </div>

</div>

@endsection
