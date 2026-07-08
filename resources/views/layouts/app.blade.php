<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'FoundIt - Smart Lost & Found')</title>

    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Sora:wght@600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/foundit.css') }}">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#2563EB',
                        'brand-dark': '#1D4ED8',
                        accent: '#22C55E',
                        surface: '#F8FAFC',
                        txt: '#0F172A',
                        'txt-secondary': '#64748B',
                    },
                    fontFamily: {
                        heading: ['Sora', 'sans-serif'],
                        body: ['DM Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    @stack('head')

</head>

<body class="h-full bg-surface text-txt font-body">

<div class="min-h-screen flex flex-col">

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-100">

    <div class="max-w-[1200px] mx-auto px-6 h-16 flex items-center justify-between">

        <a href="{{ route('home') }}" class="flex items-center gap-2 font-heading font-bold text-xl">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-brand to-blue-400 flex items-center justify-center">
                <i data-lucide="compass" class="w-5 h-5 text-white"></i>
            </div>
            <span>Found<span class="text-brand">It</span></span>
        </a>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium">

            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'text-brand font-semibold' : 'text-txt-secondary hover:text-brand transition' }}">
                Home
            </a>

            <a href="{{ route('items.explore') }}"
               class="{{ request()->routeIs('items.explore') ? 'text-brand font-semibold' : 'text-txt-secondary hover:text-brand transition' }}">
                Explore
            </a>

            <a href="{{ route('items.create') }}"
               class="{{ request()->routeIs('items.create') ? 'text-brand font-semibold' : 'text-txt-secondary hover:text-brand transition' }}">
                Post Item
            </a>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ request()->routeIs('admin.dashboard') ? 'text-brand font-semibold' : 'text-txt-secondary hover:text-brand transition' }}">
                        Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? 'text-brand font-semibold' : 'text-txt-secondary hover:text-brand transition' }}">
                        Dashboard
                    </a>
                @endif
            @endauth

        </div>

        <div class="flex items-center gap-3">

            @auth
                <a href="{{ route('profile') }}"
                   class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand border border-brand/20 rounded-xl hover:bg-blue-50 transition-all">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    {{ auth()->user()->first_name }}
                </a>

                <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-500 border border-red-200 rounded-xl hover:bg-red-50 transition-all">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand border border-brand/20 rounded-xl hover:bg-blue-50 transition-all">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    Login
                </a>
            @endauth

        </div>

    </div>

</nav>

<main class="flex-1">
    @yield('content')
</main>

<footer class="bg-white border-t border-slate-100">

    <div class="max-w-[1200px] mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">

        <div class="text-sm text-txt-secondary font-bold">
            FoundIt © {{ date('Y') }}
        </div>

        <div class="flex items-center gap-6 text-xs text-txt-secondary">
            <a href="{{ route('privacy') }}" class="hover:text-brand transition">Privacy</a>
            <a href="{{ route('terms') }}" class="hover:text-brand transition">Terms</a>
            <a href="#" class="hover:text-brand transition">Contact</a>
        </div>

    </div>

</footer>

</div>

<script>
    lucide.createIcons();
</script>

@stack('scripts')

</body>
</html>
