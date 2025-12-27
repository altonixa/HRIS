@extends('layouts.admin')

@section('header', 'Asset Inventory')

@section('content')
<div x-data="{ openAssignModal: false, openReturnModal: false, selectedAsset: null, selectedAssignment: null }">
    <div class="space-y-8">
        <!-- Asset Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-slate-900 border border-white/5 rounded-[32px] p-6 backdrop-blur-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400">
                        <i data-lucide="package" class="w-5 h-5"></i>
                    </div>
                    <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Assets</div>
                </div>
                <div class="text-2xl font-black text-white leading-none">{{ $assets->total() }}</div>
            </div>
            <div class="bg-slate-900 border border-white/5 rounded-[32px] p-6 backdrop-blur-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-400">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                    </div>
                    <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Available</div>
                </div>
                <div class="text-2xl font-black text-white leading-none">{{ $assets->where('status', 'available')->count() }}</div>
            </div>
            <div class="col-span-1 md:col-span-2 flex justify-end items-center">
                <a href="{{ route('hr-manager.assets.create') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-2xl font-black text-sm transition-all shadow-xl shadow-indigo-600/30 flex items-center gap-3">
                    <i data-lucide="plus" class="w-5 h-5"></i> Add Asset
                </a>
            </div>
        </div>

        <!-- Inventory List -->
        <div class="bg-slate-900 border border-white/5 rounded-[40px] overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5">
                        <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Asset Details</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Category</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Assigned To</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($assets as $asset)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-800 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-indigo-400 transition-colors">
                                    <i data-lucide="{{ str_contains(strtolower($asset->category), 'laptop') ? 'laptop' : (str_contains(strtolower($asset->category), 'phone') ? 'smartphone' : 'package') }}" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-black text-white">{{ $asset->name }}</div>
                                    <div class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">{{ $asset->asset_code }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-[10px] font-black text-slate-400 bg-white/5 px-3 py-1 rounded-full uppercase tracking-widest">{{ $asset->category }}</span>
                        </td>
                        <td class="px-8 py-6">
                            @php
                                $statusStyles = [
                                    'available' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                    'assigned' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20',
                                    'maintenance' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                    'disposed' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $statusStyles[$asset->status] ?? 'bg-slate-500/10 text-slate-500 border-slate-500/20' }}">
                                {{ strtoupper($asset->status) }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            @if($asset->status === 'assigned' && $asset->assignments->where('status', 'active')->first())
                                @php $activeAssign = $asset->assignments->where('status', 'active')->first(); @endphp
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-indigo-500/10 rounded-md flex items-center justify-center text-indigo-400 text-[10px] font-black">
                                        {{ substr($activeAssign->employee->first_name, 0, 1) }}
                                    </div>
                                    <div class="text-xs font-bold text-white italic">{{ $activeAssign->employee->first_name }} {{ $activeAssign->employee->last_name }}</div>
                                </div>
                            @else
                                <span class="text-[10px] text-slate-600 font-bold uppercase tracking-widest">Unassigned</span>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                @if($asset->status === 'available')
                                    <button @click="selectedAsset = {{ json_encode($asset) }}; openAssignModal = true" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg transition-all">ASSIGN</button>
                                @elseif($asset->status === 'assigned')
                                    <button @click="selectedAsset = {{ json_encode($asset) }}; selectedAssignment = {{ json_encode($asset->assignments->where('status', 'active')->first()) }}; openReturnModal = true" class="px-3 py-1.5 bg-rose-600 hover:bg-rose-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg transition-all">RETURN</button>
                                @endif
                                <a href="{{ route('hr-manager.assets.edit', $asset->id) }}" class="p-2 hover:bg-white/5 rounded-xl text-slate-400 hover:text-white transition-all"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-8 py-20 text-center text-slate-500 font-bold uppercase tracking-widest text-xs">Inventory is empty.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Assign Modal -->
    <div x-show="openAssignModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-950/80 backdrop-blur-sm">
        <div @click.away="openAssignModal = false" class="bg-slate-900 border border-white/5 w-full max-w-lg rounded-[40px] p-10 shadow-2xl animate-fade-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-indigo-500"></div>
            <h3 class="text-2xl font-black text-white tracking-tighter mb-8 italic">Asset Allocation</h3>
            
            <form :action="'/hr-manager/assets/' + (selectedAsset ? selectedAsset.id : '') + '/assign'" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Assign To Personnel *</label>
                    <select name="employee_id" required class="w-full bg-slate-800 border border-white/5 rounded-xl px-4 py-2.5 text-white focus:ring-1 focus:ring-indigo-500 appearance-none font-bold">
                        <option value="">Select Employee...</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }} ({{ $emp->employee_code }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Assignment Date *</label>
                        <input type="date" name="assigned_date" required value="{{ date('Y-m-d') }}" class="w-full bg-slate-800 border border-white/5 rounded-xl px-4 py-2.5 text-white focus:ring-1 focus:ring-indigo-500 font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Condition on Dispatch</label>
                        <input type="text" name="condition_on_assign" value="Gently Used" class="w-full bg-slate-800 border border-white/5 rounded-xl px-4 py-2.5 text-white focus:ring-1 focus:ring-indigo-500 font-bold">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Internal Deployment Notes</label>
                    <textarea name="notes" rows="3" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-4 py-3 text-white focus:ring-1 focus:ring-indigo-500 resize-none font-medium"></textarea>
                </div>
                <div class="flex gap-4 pt-6">
                    <button type="button" @click="openAssignModal = false" class="flex-1 py-4 bg-slate-800 text-white font-black text-xs uppercase tracking-widest rounded-2xl transition-all">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-indigo-600/30 transition-all">Confirm Dispatch</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Return Modal -->
    <div x-show="openReturnModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-950/80 backdrop-blur-sm">
        <div @click.away="openReturnModal = false" class="bg-slate-900 border border-rose-500/20 w-full max-w-lg rounded-[40px] p-10 shadow-2xl animate-fade-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-rose-600"></div>
            <h3 class="text-2xl font-black text-white tracking-tighter mb-8 italic">Asset De-allocation</h3>
            
            <form :action="'/hr-manager/assets/assignments/' + (selectedAssignment ? selectedAssignment.id : '') + '/return'" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Return Date *</label>
                        <input type="date" name="returned_date" required value="{{ date('Y-m-d') }}" class="w-full bg-slate-800 border border-white/5 rounded-xl px-4 py-2.5 text-white focus:ring-1 focus:ring-indigo-500 font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Condition on Return</label>
                        <input type="text" name="condition_on_return" value="Good" class="w-full bg-slate-800 border border-white/5 rounded-xl px-4 py-2.5 text-white focus:ring-1 focus:ring-indigo-500 font-bold">
                    </div>
                </div>
                <div class="flex gap-4 pt-6">
                    <button type="button" @click="openReturnModal = false" class="flex-1 py-4 bg-slate-800 text-white font-black text-xs uppercase tracking-widest rounded-2xl transition-all">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-rose-600 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-rose-600/30 transition-all">Confirm Return</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
