@if(session('success') || session('error') || session('warning') || session('info'))
<div x-data="{ show: true, type: '{{ session('error') ? 'error' : (session('warning') ? 'warning' : 'success') }}', message: '{{ session('success') ?? session('error') ?? session('warning') ?? session('info') }}' }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform -translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform -translate-y-2"
     x-init="setTimeout(() => show = false, 5000)"
     class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 flex items-center gap-3 px-6 py-3 rounded-xl shadow-2xl border border-white/10 backdrop-blur-md"
     :class="{
         'bg-emerald-500/90 text-white': type === 'success',
         'bg-rose-500/90 text-white': type === 'error',
         'bg-amber-500/90 text-white': type === 'warning'
     }">
    
    <div x-show="type === 'success'"><i data-lucide="check-circle" class="w-5 h-5"></i></div>
    <div x-show="type === 'error'"><i data-lucide="alert-circle" class="w-5 h-5"></i></div>
    <div x-show="type === 'warning'"><i data-lucide="alert-triangle" class="w-5 h-5"></i></div>

    <p class="font-medium text-sm" x-text="message"></p>

    <button @click="show = false" class="ml-2 hover:opacity-75 transition-opacity">
        <i data-lucide="x" class="w-4 h-4"></i>
    </button>
</div>
@endif
