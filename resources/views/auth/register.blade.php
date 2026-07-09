@extends('layouts.app')

@section('title', 'Register – FoundIt')

@section('content')

<div class="flex items-center justify-center p-6 py-16">

    <div class="w-full max-w-[440px] anim-fade-up">

        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 font-heading font-bold text-2xl mb-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand to-blue-400 flex items-center justify-center">
                    <i data-lucide="compass" class="w-6 h-6 text-white"></i>
                </div>
                <span>Found<span class="text-brand">It</span></span>
            </a>
            <p class="text-txt-secondary text-sm">Create an account to start reporting items.</p>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <ul class="text-red-700 text-sm font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1.5">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                               class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                               required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1.5">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                               class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                           placeholder="name@company.com" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5">WhatsApp Number <span class="text-txt-secondary font-normal">(optional)</span></label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                           placeholder="08xxxxxxxxxx">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5">Password</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                           placeholder="Min. 8 characters" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                           required>
                </div>

                <div class="flex items-start gap-2.5">
                    <input type="checkbox" name="agree_terms" id="agree_terms" required
                           class="mt-0.5 w-4 h-4 rounded border-slate-300 text-brand focus:ring-brand/30 cursor-pointer">
                    <label for="agree_terms" class="text-sm text-txt-secondary leading-snug cursor-pointer">
                        I agree to the
                        <a href="{{ route('terms') }}" class="text-brand font-medium hover:underline">Terms of Service</a>
                        and
                        <a href="{{ route('privacy') }}" class="text-brand font-medium hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit"
                        class="w-full btn-primary py-3.5 text-white font-bold rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    Create Account
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-txt-secondary">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-brand font-bold hover:underline">Sign in</a>
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