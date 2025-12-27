<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Altonixa HRIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#fcfdfc] text-slate-900 font-sans leading-relaxed overflow-x-hidden">
    <!-- Premium Header -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="/" class="text-2xl font-black tracking-tighter text-slate-900 flex items-center gap-2">
                <span class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center text-white text-lg">A</span>
                ALTONIXA <span class="text-emerald-600">HRIS</span>
            </a>
            
            <div class="hidden md:flex items-center gap-8">
                <a href="/" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Home</a>
                <a href="{{ route('public.features') }}" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Features</a>
                <a href="{{ route('public.security') }}" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Security</a>
                <a href="{{ route('public.about') }}" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">About</a>
                <a href="{{ route('careers.index') }}" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Careers</a>
            </div>

            <div class="flex items-center gap-4">
                <!-- Language Switcher -->
                <div x-data="{ open: false }" class="relative hidden sm:block">
                    <button @click="open = !open" class="flex items-center gap-2 px-3 py-1.5 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all font-bold text-slate-600">
                        <span class="text-lg">🇺🇸</span>
                        <span class="text-xs">EN</span>
                        <i data-lucide="chevron-down" class="w-3 h-3 text-slate-400"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-32 bg-white border border-slate-200 rounded-xl shadow-xl py-2 z-50 animate-slide-up">
                        <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-slate-50 transition-all text-slate-700">
                            <span class="text-lg">🇺🇸</span>
                            <span class="text-xs font-bold">English</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-slate-50 transition-all text-slate-700">
                            <span class="text-lg">🇫🇷</span>
                            <span class="text-xs font-bold">Français</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-900 hover:text-purple-600 transition-colors">Login</a>
                <a href="/#demo" class="bg-purple-600 hover:bg-purple-500 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-purple-600/20">
                    Get Started
                </a>
            </div>
        </div>
    </nav>

    <main class="pt-24 min-h-screen">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-white border-t border-slate-100 py-12 mt-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-2">
                    <a href="/" class="text-xl font-black tracking-tighter text-slate-900 mb-6 block">
                        ALTONIXA <span class="text-emerald-600">HRIS</span>
                    </a>
                    <p class="text-slate-500 max-w-md text-sm leading-relaxed">
                        The definitive Enterprise Human Resources Information System built for modern organizations, NGOs, and growth-focused companies. Streamline your workforce, automate payroll, and power your people.
                    </p>
                </div>
                <div>
                    <h4 class="text-slate-900 font-bold mb-6 text-sm uppercase tracking-widest">Platform</h4>
                    <ul class="space-y-4 text-sm text-slate-500">
                        <li><a href="{{ route('public.features') }}" class="hover:text-emerald-600 transition-colors">Features</a></li>
                        <li><a href="{{ route('public.security') }}" class="hover:text-emerald-600 transition-colors">Security</a></li>
                        <li><a href="{{ route('public.about') }}" class="hover:text-emerald-600 transition-colors">Infrastructure</a></li>
                        <li><a href="{{ route('careers.index') }}" class="hover:text-emerald-600 transition-colors">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-900 font-bold mb-6 text-sm uppercase tracking-widest">Legal</h4>
                    <ul class="space-y-4 text-sm text-slate-500">
                        <li><a href="#" class="hover:text-emerald-600 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-emerald-600 transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-emerald-600 transition-colors">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-400 text-xs text-center md:text-left">
                    © {{ date('Y') }} Altonixa Group Ltd. Engineered for enterprise excellence.
                </p>
                <div class="flex gap-6">
                    <a href="#" class="text-slate-400 hover:text-emerald-600 transition-colors"><i data-lucide="twitter" class="w-4 h-4"></i></a>
                    <a href="#" class="text-slate-400 hover:text-emerald-600 transition-colors"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                    <a href="#" class="text-slate-400 hover:text-emerald-600 transition-colors"><i data-lucide="github" class="w-4 h-4"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('bg-white/80', 'backdrop-blur-md', 'border-b', 'border-slate-100', 'py-3');
                nav.classList.remove('py-4');
            } else {
                nav.classList.remove('bg-white/80', 'backdrop-blur-md', 'border-b', 'border-slate-100', 'py-3');
                nav.classList.add('py-4');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
