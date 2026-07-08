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

        <a href="{{ route('home') }}"
           class="flex items-center justify-center gap-2 mt-8 text-sm text-txt-secondary hover:text-brand transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Home
        </a>

    </div>

</div>

@endsection
