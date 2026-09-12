@extends('layouts.app')

@section('title', 'Perbaikan Perangkat Elektronik & Rumah Tangga')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-b from-blue-50/60 via-white to-slate-50 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-blue-100/80 border border-blue-200 text-blue-800 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>Teknisi Tersertifikasi & Bergaransi</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.15]">
                    Perbaiki Perangkat Apapun, <span class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">Lebih Cepat & Transparan.</span>
                </h1>
                
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Solusi terpadu perbaikan laptop, smartphone, komputer, TV, hingga instalasi jaringan langsung ke lokasi Anda atau antar ke workshop dengan rincian biaya estimasi di awal.
                </p>

                <!-- Search & Quick Action -->
                <div class="bg-white p-2.5 sm:p-3 rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200/80 max-w-xl mx-auto lg:mx-0">
                    <form action="/services" method="GET" class="flex flex-col sm:flex-row gap-2">
                        <div class="relative flex-grow flex items-center">
                            <span class="absolute left-3.5 text-slate-400">🔍</span>
                            <input type="text" name="search" placeholder="Contoh: ganti lcd laptop, servis tv, baterai..." 
                                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-600 focus:bg-white text-slate-800 placeholder-slate-400">
                        </div>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-blue-500/25 transition transform active:scale-95 flex items-center justify-center space-x-2">
                            <span>Cari Layanan</span>
                        </button>
                    </form>
                </div>

                <!-- Trust Badges -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs text-slate-500 font-medium">
                    <div class="flex items-center space-x-2">
                        <span class="text-emerald-600 text-base">✓</span>
                        <span>Estimasi Rinci & Transparan</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-emerald-600 text-base">✓</span>
                        <span>Garansi Pekerjaan</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-emerald-600 text-base">✓</span>
                        <span>Tracking Status Real-time</span>
                    </div>
                </div>
            </div>

            <!-- Hero Feature Cards -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md bg-white rounded-3xl p-6 shadow-2xl shadow-blue-900/10 border border-slate-100">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                                💻
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">Perbaikan Aktif</h3>
                                <p class="text-xs text-slate-400">#AF-20260912-001</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-amber-100 text-amber-700">
                            Diagnosing
                        </span>
                    </div>

                    <!-- Step Tracker Simulation -->
                    <div class="py-5 space-y-3">
                        <div class="flex items-center space-x-3 text-xs">
                            <span class="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px]">✓</span>
                            <span class="text-slate-700 font-medium">Permintaan Dibuat</span>
                        </div>
                        <div class="flex items-center space-x-3 text-xs">
                            <span class="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px]">✓</span>
                            <span class="text-slate-700 font-medium">Teknisi Ditugaskan</span>
                        </div>
                        <div class="flex items-center space-x-3 text-xs">
                            <span class="w-5 h-5 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px] animate-pulse">●</span>
                            <span class="text-blue-700 font-semibold">Sedang Didiagnosa oleh Teknisi</span>
                        </div>
                        <div class="flex items-center space-x-3 text-xs text-slate-400">
                            <span class="w-5 h-5 rounded-full bg-slate-100 border border-slate-300 text-slate-400 flex items-center justify-center text-[10px]">○</span>
                            <span>Persetujuan Penawaran Biaya</span>
                        </div>
                        <div class="flex items-center space-x-3 text-xs text-slate-400">
                            <span class="w-5 h-5 rounded-full bg-slate-100 border border-slate-300 text-slate-400 flex items-center justify-center text-[10px]">○</span>
                            <span>Pengerjaan Selesai & Bergaransi</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <div class="flex items-center space-x-2">
                            <div class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center text-xs">👨‍🔧</div>
                            <span class="font-semibold text-slate-800">Teknisi Handal</span>
                        </div>
                        <a href="/services" class="text-blue-600 font-semibold hover:underline">Pesan Sekarang &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-16 bg-white border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">Alur Mudah & Praktis</h2>
        <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-12">Cara Kerja AnyFix Service</p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 text-left relative group hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl font-bold mb-4">1</div>
                <h3 class="font-bold text-base text-slate-800 mb-2">Pilih Layanan</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Pilih kategori kerusakan perangkat Anda dan jelaskan gejala yang dialami.</p>
            </div>
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 text-left relative group hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center text-xl font-bold mb-4">2</div>
                <h3 class="font-bold text-base text-slate-800 mb-2">Penugasan Teknisi</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Teknisi spesialis ditugaskan untuk memeriksa dan mendiagnosa langsung.</p>
            </div>
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 text-left relative group hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl font-bold mb-4">3</div>
                <h3 class="font-bold text-base text-slate-800 mb-2">Rincian Penawaran</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Dapatkan estimasi biaya suku cadang & jasa perbaikan sebelum pengerjaan dimulai.</p>
            </div>
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 text-left relative group hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl font-bold mb-4">4</div>
                <h3 class="font-bold text-base text-slate-800 mb-2">Selesai & Garansi</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Konfirmasi hasil perbaikan, bayar secara aman, dan berikan review pada teknisi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10">
            <div>
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">Kategori Perangkat</h2>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900">Solusi Perbaikan Spesialis</p>
            </div>
            <a href="/services" class="mt-4 sm:mt-0 text-sm font-semibold text-blue-600 hover:text-blue-700 flex items-center space-x-1">
                <span>Lihat Semua Layanan</span>
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($categories as $category)
                <a href="/services?category={{ $category->slug }}" 
                   class="bg-white rounded-2xl p-5 border border-slate-200/80 hover:border-blue-400 hover:shadow-lg hover:-translate-y-1 transition duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition transform">
                            {{ $category->icon ?? '🔧' }}
                        </div>
                        <h3 class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-blue-600 transition">
                            {{ $category->name }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                            {{ $category->description }}
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400 font-medium">
                        <span>{{ $category->services_count }} Layanan</span>
                        <span class="text-blue-600 group-hover:translate-x-1 transition transform">&rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Popular Services Section -->
<section class="py-16 bg-white border-t border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">Layanan Terfavorit</h2>
            <p class="text-2xl sm:text-3xl font-extrabold text-slate-900">Paling Sering Dibutuhkan Pelanggan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularServices as $service)
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-xl hover:border-blue-300 transition duration-200 flex flex-col justify-between group">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-[11px] font-semibold">
                                {{ $service->category->name }}
                            </span>
                            <span class="text-xs text-slate-400 flex items-center space-x-1">
                                <span>⏱️</span>
                                <span>{{ $service->estimated_duration ?? '1-2 jam' }}</span>
                            </span>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 group-hover:text-blue-600 transition">
                            {{ $service->name }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                            {{ $service->description }}
                        </p>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-medium uppercase">Mulai Dari</span>
                            <span class="text-base font-extrabold text-slate-900">
                                Rp {{ number_format($service->base_price, 0, ',', '.') }}
                            </span>
                        </div>
                        <a href="/requests/create?service_id={{ $service->id }}" 
                           class="px-3.5 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-xs transition active:scale-95">
                            Pesan Layanan
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Demo Credentials Banner -->
<section class="py-12 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-800/80 border border-slate-700 rounded-3xl p-6 sm:p-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-semibold mb-2">
                        <span>🔑 Akun Demo Pengujian (Seksi 67)</span>
                    </div>
                    <h3 class="text-xl font-bold">Kredensial Login Tersedia</h3>
                    <p class="text-xs text-slate-400 mt-1 max-w-xl">
                        Semua akun di bawah telah di-seed dengan password default: <code class="bg-slate-900 px-2 py-0.5 rounded text-amber-400 font-mono">password123</code>.
                    </p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 w-full md:w-auto text-xs">
                    <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-700">
                        <span class="text-[10px] text-purple-400 font-bold uppercase block">Admin</span>
                        <span class="font-mono text-slate-200">admin@anyfix.com</span>
                    </div>
                    <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-700">
                        <span class="text-[10px] text-blue-400 font-bold uppercase block">Teknisi</span>
                        <span class="font-mono text-slate-200">budi.technician@anyfix.com</span>
                    </div>
                    <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-700">
                        <span class="text-[10px] text-emerald-400 font-bold uppercase block">Customer</span>
                        <span class="font-mono text-slate-200">andi.customer@anyfix.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

