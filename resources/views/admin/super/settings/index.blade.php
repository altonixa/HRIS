@extends('layouts.admin')

@section('header', 'System Configuration')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white mb-1">System Settings</h1>
        <p class="text-slate-400 text-sm">Configure global application branding and preferences.</p>
    </div>

    <form action="{{ route('super-admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Branding Section -->
        <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
            <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="palette" class="w-5 h-5 text-indigo-400"></i> Branding
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Organization Name</label>
                    <input type="text" name="app_name" value="{{ $settings['app_name'] ?? config('app.name') }}" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Primary Color (Hex)</label>
                    <div class="flex gap-2">
                        <input type="color" name="primary_color" value="{{ $settings['primary_color'] ?? '#6366f1' }}" class="h-10 w-10 bg-transparent border-none rounded cursor-pointer">
                        <input type="text" name="primary_text_color" value="{{ $settings['primary_color'] ?? '#6366f1' }}" class="flex-1 bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary transition-colors font-mono">
                    </div>
                </div>

                <div class="col-span-full">
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Upload Logo (PNG/SVG)</label>
                    <div class="border-2 border-dashed border-slate-700 rounded-lg p-6 text-center hover:border-primary/50 transition-colors cursor-pointer bg-slate-900/50">
                        <input type="file" name="logo" class="hidden" id="logo-upload">
                        <label for="logo-upload" class="cursor-pointer">
                            <i data-lucide="upload-cloud" class="w-8 h-8 text-slate-500 mx-auto mb-2"></i>
                            <p class="text-sm text-slate-400">Click to upload or drag and drop</p>
                            <p class="text-xs text-slate-600 mt-1">Maximum file size: 2MB</p>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Localization Section -->
        <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
            <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="globe" class="w-5 h-5 text-emerald-400"></i> Localization
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Currency Symbol</label>
                    <input type="text" name="currency_symbol" value="{{ $settings['currency_symbol'] ?? 'XAF' }}" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Date Format</label>
                    <select name="date_format" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors">
                        <option value="d M, Y">DD MMM, YYYY (26 Dec, 2025)</option>
                        <option value="Y-m-d">YYYY-MM-DD (2025-12-26)</option>
                        <option value="d/m/Y">DD/MM/YYYY (26/12/2025)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-lg font-medium shadow-lg shadow-primary/25 transition-all flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i> Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
