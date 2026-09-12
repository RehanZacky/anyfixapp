<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AnyFix Service') }} - @yield('title', 'Solusi Perbaikan Terpercaya')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full flex flex-col text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

    <!-- Flash Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-emerald-800 border border-emerald-200 rounded-xl bg-emerald-50 shadow-lg transition-all" role="alert">
            <svg class="flex-shrink-0 w-5 h-5 mr-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <div class="text-sm font-semibold">{{ session('success') }}</div>
            <button @click="show = false" class="ml-4 text-emerald-600 hover:text-emerald-900">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
             class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-rose-800 border border-rose-200 rounded-xl bg-rose-50 shadow-lg transition-all" role="alert">
            <svg class="flex-shrink-0 w-5 h-5 mr-3 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <div class="text-sm font-semibold">{{ session('error') }}</div>
            <button @click="show = false" class="ml-4 text-rose-600 hover:text-rose-900">&times;</button>
        </div>
    @endif

    <!-- Main Navigation Bar -->
    @include('layouts.navigation')

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 text-white font-bold text-xl mb-3">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center text-white text-base">🔧</span>
                        <span>AnyFix<span class="text-blue-500">Service</span></span>
                    </div>
                    <p class="text-sm text-slate-400 max-w-sm leading-relaxed">
                        Platform on-demand perbaikan dan perawatan perangkat elektronik & rumah tangga dengan teknisi tersertifikasi, estimasi transparan, dan bergaransi.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-sm mb-4">Layanan Populer</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Reparasi Laptop & Komputer</a></li>
                        <li><a href="#" class="hover:text-white transition">Ganti Layar Smartphone</a></li>
                        <li><a href="#" class="hover:text-white transition">Servis TV & Peralatan Rumah</a></li>
                        <li><a href="#" class="hover:text-white transition">Troubleshooting Jaringan / Wi-Fi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-sm mb-4">Akses Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-white transition">Semua Kategori</a></li>
                        <li><a href="#" class="hover:text-white transition">Portal Teknisi</a></li>
                        <li><a href="#" class="hover:text-white transition">Admin Dashboard</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center text-xs">
                <p>&copy; {{ date('Y') }} AnyFix Service Platform. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 sm:mt-0">
                    <span class="text-slate-500">REST API & Multi-role Service Engine</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
