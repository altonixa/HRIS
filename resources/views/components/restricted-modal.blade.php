<div x-data="{ open: false }" 
     @restricted.window="open = true"
     x-show="open" 
     class="fixed inset-0 z-[100] overflow-y-auto" 
     style="display: none;">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" @click="open = false"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative transform overflow-hidden rounded-2xl bg-slate-900 border border-white/10 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md">
            
            <div class="p-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-rose-500/10 mb-6">
                    <i data-lucide="shield-alert" class="h-8 w-8 text-rose-500"></i>
                </div>
                
                <div class="text-center">
                    <h3 class="text-xl font-black text-white mb-2 uppercase tracking-tight">Access Restricted</h3>
                    <p class="text-sm text-slate-400">
                        This feature is currently locked or requires a higher clearance level. Please contact your system administrator if you believe this is an error.
                    </p>
                </div>
            </div>

            <div class="bg-white/5 p-4 flex justify-center">
                <button @click="open = false" class="w-full bg-slate-800 hover:bg-slate-700 text-white font-bold py-3 rounded-xl transition-all border border-white/5 shadow-lg">
                    Understood
                </button>
            </div>
        </div>
    </div>
</div>
