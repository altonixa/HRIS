<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Altonixa HRIS') }} - Enterprise Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-size: 0.85rem; }
        .sidebar { width: 260px; }
        .sidebar.collapsed { width: 80px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#fcfdfc] text-slate-900 font-sans leading-relaxed selection:bg-emerald-500/20" 
      x-data="{ sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true' }" 
      x-init="$watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', val))">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="sidebar bg-white border-r border-slate-200 flex flex-col transition-all duration-300 z-50 shadow-sm" 
               :class="{ 'collapsed': sidebarCollapsed }">
            
            <div class="h-20 flex items-center justify-between px-6 border-b border-slate-100 bg-white">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-purple-600/20 group-hover:scale-110 transition-transform">
                        <span class="font-black text-lg">A</span>
                    </div>
                    <div class="transition-opacity duration-300" :class="{ 'opacity-0 hidden': sidebarCollapsed }">
                        <div class="text-sm font-black tracking-tighter text-slate-900 uppercase leading-none">ALTONIXA</div>
                        <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest leading-none mt-1">HRIS PRO</div>
                    </div>
                </a>
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-slate-900 transition-all" :class="{ 'hidden': sidebarCollapsed }">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto py-6 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Dashboard</span>
                </a>

                @hasanyrole('HR Manager|Super Admin|Organization Admin')
                <div class="px-8 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest" :class="{ 'hidden': sidebarCollapsed }">Human Resources</div>
                <a href="{{ route('hr-manager.employees.index') }}" class="nav-item {{ request()->routeIs('hr-manager.employees.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="users" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Employees</span>
                </a>
                <a href="{{ route('hr-manager.leaves.index') }}" class="nav-item {{ request()->routeIs('hr-manager.leaves.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="calendar-off" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Leave Requests</span>
                </a>

                <div class="px-8 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest" :class="{ 'hidden': sidebarCollapsed }">Learning & Growth</div>
                <a href="{{ route('hr-manager.courses.index') }}" class="nav-item {{ request()->routeIs('hr-manager.courses.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="library" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Course Catalog</span>
                </a>
                <a href="{{ route('hr-manager.trainings.index') }}" class="nav-item {{ request()->routeIs('hr-manager.trainings.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="graduation-cap" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Training Matrix</span>
                </a>
                <a href="{{ route('hr-manager.shifts.index') }}" class="nav-item {{ request()->routeIs('hr-manager.shifts.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="clock-4" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Shift Scheduling</span>
                </a>
                
                <div class="px-8 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest" :class="{ 'hidden': sidebarCollapsed }">Financials</div>
                <a href="{{ route('hr-manager.payroll.index') }}" class="nav-item {{ request()->routeIs('hr-manager.payroll.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="wallet" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Payroll Engine</span>
                </a>
                <a href="{{ route('hr-manager.salaries.index') }}" class="nav-item {{ request()->routeIs('hr-manager.salaries.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="coins" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Salary Bands</span>
                </a>
                <a href="{{ route('hr-manager.expenses.index') }}" class="nav-item {{ request()->routeIs('hr-manager.expenses.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="receipt" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Expense Audits</span>
                </a>
                <a href="{{ route('hr-manager.assets.index') }}" class="nav-item {{ request()->routeIs('hr-manager.assets.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="package" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Asset Inventory</span>
                </a>

                <div class="px-8 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest" :class="{ 'hidden': sidebarCollapsed }">Talent & ATS</div>
                <a href="{{ route('hr-manager.recruitment.index') }}" class="nav-item {{ request()->routeIs('hr-manager.recruitment.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="briefcase" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Job Board</span>
                </a>
                <a href="{{ route('hr-manager.applications.index') }}" class="nav-item {{ request()->routeIs('hr-manager.applications.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="user-search" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Applicants</span>
                </a>

                <div class="px-8 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest" :class="{ 'hidden': sidebarCollapsed }">Strategy</div>
                <a href="{{ route('hr-manager.reports.index') }}" class="nav-item {{ request()->routeIs('hr-manager.reports.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="bar-chart-3" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Export Reports</span>
                </a>
                @endhasanyrole

                @role('Employee')
                <div class="px-8 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest" :class="{ 'hidden': sidebarCollapsed }">My Workspace</div>
                <a href="{{ route('employee.profile') }}" class="nav-item {{ request()->routeIs('employee.profile') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="user-circle" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">My Identity</span>
                </a>
                <a href="{{ route('employee.attendance.index') }}" class="nav-item {{ request()->routeIs('employee.attendance.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="qr-code" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Clock In/Out</span>
                </a>
                <a href="{{ route('employee.leaves.index') }}" class="nav-item {{ request()->routeIs('employee.leaves.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="calendar" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">My Leaves</span>
                </a>
                <a href="{{ route('employee.appraisals.index') }}" class="nav-item {{ request()->routeIs('employee.appraisals.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="award" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Performances</span>
                </a>
                <a href="{{ route('employee.expenses.index') }}" class="nav-item {{ request()->routeIs('employee.expenses.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="receipt" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Claims & Refunds</span>
                </a>
                <a href="{{ route('employee.assets.index') }}" class="nav-item {{ request()->routeIs('employee.assets.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="package" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">My Equipment</span>
                </a>
                <a href="{{ route('employee.trainings.index') }}" class="nav-item {{ request()->routeIs('employee.trainings.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="graduation-cap" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">My Learning</span>
                </a>
                @endrole

                @role('Super Admin')
                <div class="px-8 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest" :class="{ 'hidden': sidebarCollapsed }">Administration</div>
                <a href="{{ route('super-admin.users.index') }}" class="nav-item {{ request()->routeIs('super-admin.users.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="shield-check" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Users & Access</span>
                </a>
                <a href="{{ route('super-admin.audit.index') }}" class="nav-item {{ request()->routeIs('super-admin.audit.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="eye" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">Security Logs</span>
                </a>
                <a href="{{ route('super-admin.settings.index') }}" class="nav-item {{ request()->routeIs('super-admin.settings.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <i data-lucide="settings-2" class="w-5 h-5 shrink-0"></i>
                    <span class="whitespace-nowrap" :class="{ 'hidden': sidebarCollapsed }">System Config</span>
                </a>
                @endrole
            </div>

            <!-- Profile Info at Bottom -->
            <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                <div class="flex items-center gap-3 transition-opacity duration-300" :class="{ 'opacity-0 hidden': sidebarCollapsed }">
                    <div class="w-10 h-10 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-600 font-black border border-emerald-500/20 shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs font-black text-slate-900 truncate uppercase tracking-tighter">{{ Auth::user()->name }}</div>
                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ Auth::user()->roles->first()->name ?? 'Portal' }}</div>
                    </div>
                    <button onclick="document.getElementById('logout-form').submit()" class="text-slate-400 hover:text-rose-500 transition-colors">
                        <i data-lucide="power" class="w-4 h-4"></i>
                    </button>
                </div>
                <button @click="sidebarCollapsed = !sidebarCollapsed" x-show="sidebarCollapsed" class="mx-auto block p-2 bg-emerald-600 rounded-lg text-white">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-40 backdrop-blur-md bg-white/80">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                    <h1 class="text-xl font-black tracking-tighter text-slate-900 uppercase tracking-widest">
                        @yield('header', 'Insights')
                    </h1>
                </div>

                <div class="flex items-center gap-6">
                    <!-- Notifications -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="text-slate-400 hover:text-slate-900 transition-colors relative">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-emerald-600 rounded-full border-2 border-white"></span>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-4 w-80 bg-white border border-slate-200 rounded-3xl shadow-2xl overflow-hidden py-4 z-50 animate-slide-up">
                            <div class="px-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                                <span class="text-[10px] font-black uppercase text-slate-400">Notifications</span>
                                <span class="text-[10px] font-bold text-emerald-600">Mark all as read</span>
                            </div>
                            <div class="max-h-64 overflow-y-auto px-2">
                                <div class="p-4 hover:bg-slate-50 rounded-2xl transition-all cursor-pointer">
                                    <div class="text-sm font-bold text-slate-900 mb-1">New Leave Request</div>
                                    <p class="text-xs text-slate-500 leading-relaxed">John Doe submitted a vacation request for next week.</p>
                                    <span class="text-[10px] text-emerald-600 font-bold mt-2 inline-block">2 MIN AGO</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Language Switcher -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 transition-all">
                            <span class="text-lg">🇺🇸</span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">EN</span>
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

                    <!-- Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 bg-slate-50 hover:bg-slate-100 p-1.5 pr-4 rounded-2xl transition-all border border-slate-200">
                            <div class="w-8 h-8 rounded-xl bg-purple-600 flex items-center justify-center font-black text-xs text-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-4 w-56 bg-white border border-slate-200 rounded-3xl shadow-2xl overflow-hidden py-2 z-50 animate-slide-up">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-all">
                                <i data-lucide="user" class="w-4 h-4"></i> Profile
                            </a>
                            <a href="{{ route('super-admin.settings.index') }}" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-all">
                                <i data-lucide="settings" class="w-4 h-4"></i> Settings
                            </a>
                            <div class="h-px bg-slate-100 my-2 mx-4"></div>
                            <button onclick="document.getElementById('logout-form').submit()" class="w-full flex items-center gap-3 px-6 py-3 text-sm font-bold text-rose-600 hover:bg-rose-50 transition-all text-left">
                                <i data-lucide="power" class="w-4 h-4"></i> Logout
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-12 bg-[#fcfdfc]">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="h-14 bg-white border-t border-slate-200 flex items-center justify-between px-12">
                <div class="flex items-center gap-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <span>ALTONIXA HRIS</span>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <span>© {{ date('Y') }}</span>
                </div>
                <div class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">
                    Enterprise Portal v4.0.0 Stable
                </div>
            </footer>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">@csrf</form>
    <x-toast />
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>
