<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>
<body class="h-full bg-gray-100 font-sans antialiased">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="h-16 flex items-center px-6 bg-gray-800 border-b border-gray-700">
            <h1 class="text-2xl font-bold">{{ config('app.name') }}</h1>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-semibold">Dashboard</span>
            </a>

            <!-- Admins Module -->
            <a href="{{ url('admins') }}"
{{--            <a href=""--}}
               class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admins.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21h3a2 2 0 002-2v-1a6 6 0 00-12 0v1a2 2 0 002 2h3m-6-4a9 9 0 1118 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9v.001"></path>
                </svg>
                <span class="font-semibold">All Users</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-4 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-semibold">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow-sm border-b border-gray-200 h-16 flex items-center px-8">
            <h2 class="text-2xl font-bold text-gray-800">@yield('header')</h2>
            <div class="ml-auto flex items-center gap-4">
{{--                <span class="text-gray-600">{{ Auth::user()->name }}</span>--}}
                <span class="text-gray-600"></span>
                <img src="" alt="Avatar" class="h-10 w-10 rounded-full">
            </div>
        </header>

        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
</div>
@livewireScripts
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
