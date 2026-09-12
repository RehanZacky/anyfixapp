<nav x-data="{ mobileMenuOpen: false }" class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200/80 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-2.5 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition transform">
                        <span class="text-xl">🔧</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-lg leading-tight tracking-tight text-slate-900">AnyFix<span class="text-blue-600">Service</span></span>
                        <span class="text-[10px] font-medium tracking-wider text-slate-400 uppercase">Repair & Maintenance</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:ml-10 md:flex md:space-x-1">
                    <a href="/" class="px-3.5 py-2 text-sm font-medium rounded-lg text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition">
                        Beranda
                    </a>
                    <a href="/services" class="px-3.5 py-2 text-sm font-medium rounded-lg text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition">
                        Layanan
                    </a>
                    @auth
                        @if(Auth::user()->role === 'customer')
                            <a href="/requests" class="px-3.5 py-2 text-sm font-medium rounded-lg text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition">
                                Pesanan Saya
                            </a>
                        @elseif(Auth::user()->role === 'technician')
                            <a href="/technician/dashboard" class="px-3.5 py-2 text-sm font-medium rounded-lg text-blue-700 bg-blue-50 hover:bg-blue-100 transition">
                                Dashboard Teknisi
                            </a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="/admin/dashboard" class="px-3.5 py-2 text-sm font-medium rounded-lg text-purple-700 bg-purple-50 hover:bg-purple-100 transition">
                                Panel Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Actions / User Profile -->
            <div class="hidden md:flex md:items-center md:space-x-3">
                @guest
                    <a href="/login" class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 transition">
                        Masuk
                    </a>
                    <a href="/register" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-sm shadow-blue-500/20 transition active:scale-95">
                        Daftar Akun
                    </a>
                @else
                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative" @click.outside="open = false">
                        <button @click="open = !open" class="flex items-center space-x-2.5 px-3 py-1.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-white transition focus:outline-hidden">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center font-bold text-xs text-blue-600">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="text-left hidden lg:block">
                                <p class="text-xs font-semibold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                                <span class="text-[10px] font-medium text-slate-500 uppercase">{{ Auth::user()->role }}</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition
                             class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 py-1.5 z-50">
                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-xs text-slate-400">Login sebagai</p>
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            
                            @if(Auth::user()->role === 'admin')
                                <a href="/admin/dashboard" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50">
                                    ⚙️ Dashboard Admin
                                </a>
                            @elseif(Auth::user()->role === 'technician')
                                <a href="/technician/dashboard" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50">
                                    🛠️ Dashboard Teknisi
                                </a>
                            @else
                                <a href="/requests" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50">
                                    📋 Pesanan Saya
                                </a>
                                <a href="/profile" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50">
                                    👤 Pengaturan Profil
                                </a>
                            @endif

                            <div class="border-t border-slate-100 mt-1">
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition">
                                        🚪 Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-hidden">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu panel -->
    <div x-show="mobileMenuOpen" class="md:hidden border-b border-slate-200 bg-white px-4 pt-2 pb-4 space-y-1">
        <a href="/" class="block px-3 py-2 text-base font-medium rounded-lg text-slate-700 hover:bg-slate-50">Beranda</a>
        <a href="/services" class="block px-3 py-2 text-base font-medium rounded-lg text-slate-700 hover:bg-slate-50">Layanan</a>
        @guest
            <div class="pt-3 border-t border-slate-100 flex flex-col space-y-2">
                <a href="/login" class="text-center px-4 py-2.5 text-sm font-semibold rounded-xl border border-slate-300 text-slate-700">Masuk</a>
                <a href="/register" class="text-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-blue-600 text-white">Daftar Akun</a>
            </div>
        @else
            <div class="pt-3 border-t border-slate-100">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-sm font-semibold text-rose-600 rounded-lg hover:bg-rose-50">
                        Keluar ({{ Auth::user()->name }})
                    </button>
                </form>
            </div>
        @endguest
    </div>
</nav>
