@extends('layouts.admin')

@section('header', 'Employee Profile')

@section('content')
<div x-data="{ activeTab: 'summary' }">
    <!-- Profile Header -->
    <div class="bg-white border border-slate-200 rounded-xl p-8 mb-8 relative overflow-hidden shadow-sm">
        <div class="absolute top-0 right-0 p-12 opacity-5 pointer-events-none">
            <i data-lucide="users" class="w-48 h-48 text-purple-500"></i>
        </div>
        
        <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
            <div class="w-32 h-32 rounded-xl bg-purple-600 flex items-center justify-center text-white text-5xl font-black shadow-lg">
                @if($employee->profile_picture)
                    <img src="{{ Storage::url($employee->profile_picture) }}" class="w-full h-full object-cover rounded-xl">
                @else
                    {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                @endif
            </div>
            
            <div class="flex-1 text-center md:text-left">
                <div class="flex flex-wrap items-center gap-3 justify-center md:justify-start mb-2">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter">{{ $employee->first_name }} {{ $employee->last_name }}</h1>
                    <span class="badge badge-primary text-[10px]">{{ $employee->employee_code }}</span>
                    <span class="badge {{ $employee->status === 'active' ? 'badge-success' : 'badge-warning' }} text-[10px]">{{ strtoupper($employee->status) }}</span>
                </div>
                <p class="text-slate-500 font-bold mb-4 uppercase tracking-widest text-xs">
                    {{ $employee->designation->name ?? 'Designation Not Set' }} • {{ $employee->department->name ?? 'Department Not Set' }}
                </p>
                <div class="flex flex-wrap gap-6 justify-center md:justify-start">
                    <div class="flex items-center gap-2 text-slate-500 text-sm font-medium">
                        <i data-lucide="mail" class="w-4 h-4 text-purple-600"></i>
                        {{ $employee->user->email }}
                    </div>
                    <div class="flex items-center gap-2 text-slate-500 text-sm font-medium">
                        <i data-lucide="phone" class="w-4 h-4 text-purple-600"></i>
                        {{ $employee->phone ?? 'No Phone' }}
                    </div>
                    <div class="flex items-center gap-2 text-slate-500 text-sm font-medium">
                        <i data-lucide="calendar" class="w-4 h-4 text-purple-600"></i>
                        Joined {{ $employee->joining_date ? $employee->joining_date->format('M d, Y') : 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('hr-manager.employees.edit', $employee->id) }}" class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-6 py-3 rounded-xl font-bold transition-all border border-slate-200 flex items-center gap-2 shadow-sm">
                    <i data-lucide="edit" class="w-4 h-4"></i> Edit Profile
                </a>
                <button class="bg-rose-50 hover:bg-rose-100 text-rose-600 p-3 rounded-xl transition-all border border-rose-200 shadow-sm">
                    <i data-lucide="user-minus" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex gap-2 mb-8 bg-slate-100 p-1.5 rounded-xl border border-slate-200 w-fit">
        <button @click="activeTab = 'summary'" :class="activeTab === 'summary' ? 'bg-purple-600 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200'" class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
            <i data-lucide="user" class="w-4 h-4"></i> Summary
        </button>
        <button @click="activeTab = 'documents'" :class="activeTab === 'documents' ? 'bg-purple-600 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200'" class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
            <i data-lucide="file-text" class="w-4 h-4"></i> Documents
            <span class="bg-black/5 text-[10px] px-1.5 py-0.5 rounded-md">{{ $employee->documents->count() }}</span>
        </button>
        <button @click="activeTab = 'contacts'" :class="activeTab === 'contacts' ? 'bg-purple-600 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200'" class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
            <i data-lucide="contact-2" class="w-4 h-4"></i> Emergency Contacts
        </button>
        <button @click="activeTab = 'employment'" :class="activeTab === 'employment' ? 'bg-purple-600 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200'" class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
            <i data-lucide="briefcase" class="w-4 h-4"></i> Employment Details
        </button>
        <button @click="activeTab = 'learning'" :class="activeTab === 'learning' ? 'bg-purple-600 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200'" class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
            <i data-lucide="graduation-cap" class="w-4 h-4"></i> Skills & Growth
        </button>
    </div>

    <!-- Tab Contents -->
    <div class="space-y-8">
        <!-- Summary Tab -->
        <div x-show="activeTab === 'summary'" x-cloak class="animate-fade-in">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Personal Info -->
                <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <i data-lucide="info" class="w-5 h-5 text-purple-600"></i> Personal Information
                    </h3>
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Gender</label>
                                <div class="text-sm font-bold text-slate-900">{{ strtoupper($employee->gender ?? 'Not Set') }}</div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Date of Birth</label>
                                <div class="text-sm font-bold text-slate-900">{{ $employee->dob ? $employee->dob->format('M d, Y') : 'Not Set' }}</div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Full Address</label>
                            <div class="text-sm font-bold text-slate-900 leading-relaxed">
                                {{ $employee->address ?? 'No Address' }}<br>
                                {{ $employee->quarter ? $employee->quarter . ', ' : '' }} {{ $employee->town ?? '' }}<br>
                                {{ $employee->city ?? '' }}, {{ $employee->country ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity/Stats -->
                <div class="space-y-8">
                    <x-activity-feed title="Employee Lifecycle Feed">
                        <div class="activity-item">
                            <div class="activity-icon bg-emerald-500/10 text-emerald-600"><i data-lucide="check" class="w-4 h-4"></i></div>
                            <div class="activity-content">
                                <div class="activity-title text-slate-900 font-bold">Joined Organization</div>
                                <div class="activity-description text-slate-500">Official onboarding completed.</div>
                                <div class="activity-time text-slate-400">{{ $employee->joining_date->diffForHumans() }}</div>
                            </div>
                        </div>
                    </x-activity-feed>
                </div>
            </div>
        </div>

        <!-- Documents Tab -->
        <div x-show="activeTab === 'documents'" x-cloak class="animate-fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-900">Document Repository</h3>
                <button @click="$dispatch('open-modal', 'upload-document')" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-2 shadow-sm transition-all">
                    <i data-lucide="upload" class="w-4 h-4"></i> Upload New Document
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($employee->documents as $doc)
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:border-purple-500/30 transition-all group shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center text-purple-600">
                            <i data-lucide="file-text" class="w-6 h-6"></i>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-purple-600 transition-all" title="View Document">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('hr-manager.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Delete this document?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 hover:bg-rose-50 rounded-lg text-slate-400 hover:text-rose-600 transition-all" title="Delete Document">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h4 class="text-slate-900 font-bold mb-1 truncate">{{ $doc->title }}</h4>
                    <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-4">{{ $doc->type }}</p>
                    
                    <div class="border-t border-slate-100 pt-4 flex justify-between items-center">
                        <div class="text-[10px] text-slate-500">
                            @if($doc->expiry_date)
                                <span class="{{ $doc->expiry_date->isPast() ? 'text-rose-500' : 'text-amber-500' }} font-bold">Expires: {{ $doc->expiry_date->format('M d, Y') }}</span>
                            @else
                                <span class="text-emerald-600 font-bold">No Expiry</span>
                            @endif
                        </div>
                        <span class="badge {{ $doc->status === 'Active' ? 'badge-success' : 'badge-danger' }} text-[8px]">{{ $doc->status }}</span>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center bg-slate-50 border border-dashed border-slate-200 rounded-xl">
                    <div class="w-16 h-16 bg-slate-200 rounded-xl flex items-center justify-center text-slate-400 mx-auto mb-4">
                        <i data-lucide="file-question" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-slate-900 font-bold mb-2">No documents found</h3>
                    <p class="text-slate-500 text-sm">Upload contracts, ID cards, or certifications.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Contacts Tab -->
        <div x-show="activeTab === 'contacts'" x-cloak class="animate-fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-900">Emergency Contacts</h3>
                <button @click="$dispatch('open-modal', 'add-contact')" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-2 shadow-sm transition-all">
                    <i data-lucide="plus" class="w-4 h-4"></i> Add Contact
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($employee->emergencyContacts as $contact)
                <div class="bg-white border {{ $contact->is_primary ? 'border-emerald-500/30 ring-1 ring-emerald-500/10' : 'border-slate-200' }} rounded-xl p-8 relative overflow-hidden group shadow-sm">
                    @if($contact->is_primary)
                        <div class="absolute top-0 right-0 px-4 py-1.5 bg-emerald-600 text-white text-[8px] font-black uppercase tracking-widest rounded-bl-xl">Primary</div>
                    @endif
                    
                    <div class="flex items-center gap-6 mb-6">
                        <div class="w-14 h-14 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500 font-black text-xl border border-slate-200">
                            {{ substr($contact->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold text-lg">{{ $contact->name }}</h4>
                            <p class="text-xs text-purple-600 font-bold uppercase tracking-widest">{{ $contact->relationship }}</p>
                        </div>
                    </div>
...
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-4 text-slate-600 text-sm font-medium">
                            <i data-lucide="phone" class="w-4 h-4 text-slate-400"></i>
                            {{ $contact->phone }}
                        </div>
                        @if($contact->email)
                        <div class="flex items-center gap-4 text-slate-600 text-sm font-medium">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                            {{ $contact->email }}
                        </div>
                        @endif
                        @if($contact->address)
                        <div class="flex items-center gap-4 text-slate-600 text-sm font-medium">
                            <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                            <span class="line-clamp-1">{{ $contact->address }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="flex gap-2 pt-6 border-t border-slate-100">
                        <form action="{{ route('hr-manager.emergency-contacts.destroy', $contact->id) }}" method="POST" class="w-full flex gap-2" onsubmit="return confirm('Remove this contact?')">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="flex-1 py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 text-[10px] font-bold rounded-xl border border-slate-200 transition-all">EDIT</button>
                            <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl transition-all"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center bg-slate-50 border border-dashed border-slate-200 rounded-xl">
                    <div class="w-16 h-16 bg-slate-200 rounded-xl flex items-center justify-center text-slate-400 mx-auto mb-4">
                        <i data-lucide="phone-off" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-slate-900 font-bold mb-2">No contacts registered</h3>
                    <p class="text-slate-500 text-sm">At least one primary contact is recommended for safety compliance.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Employment Tab -->
        <div x-show="activeTab === 'employment'" x-cloak class="animate-fade-in">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Workflow Settings</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Direct Reporting Manager</label>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-purple-500/10 rounded-lg flex items-center justify-center text-purple-600 font-bold text-xs border border-purple-500/20">
                                    {{ $employee->manager ? substr($employee->manager->first_name, 0, 1) : '?' }}
                                </div>
                                <div class="text-sm font-bold text-slate-900">
                                    {{ $employee->manager ? $employee->manager->first_name . ' ' . $employee->manager->last_name : 'No Manager Assigned' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Learning Tab -->
        <div x-show="activeTab === 'learning'" x-cloak class="animate-fade-in">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-xl font-black text-slate-900 tracking-widest uppercase">Competency Matrix</h3>
                    <p class="text-slate-500 text-xs font-bold mt-1">Professional development and certification tracking.</p>
                </div>
                <a href="{{ route('hr-manager.trainings.create', ['employee_id' => $employee->id]) }}" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 shadow-sm transition-all">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> Deploy Training
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($employee->trainings as $training)
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:border-purple-500/30 transition-all relative overflow-hidden group shadow-sm">
                    <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
                        <i data-lucide="award" class="w-12 h-12 text-purple-600"></i>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <span class="badge {{ $training->status === 'completed' ? 'badge-success' : 'badge-primary' }} text-[8px] font-black tracking-widest px-3">
                            {{ strtoupper(str_replace('_', ' ', $training->status)) }}
                        </span>
                        @if($training->certificate_path)
                            <a href="{{ Storage::url($training->certificate_path) }}" target="_blank" class="text-purple-600 hover:text-purple-700 transition-colors">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </div>
...
                    <h4 class="text-slate-900 font-extrabold text-sm mb-1 leading-tight">{{ $training->course->title }}</h4>
                    <p class="text-[9px] text-slate-500 font-black uppercase tracking-widest mb-6">{{ $training->course->code }}</p>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center text-[10px] font-bold">
                            <span class="text-slate-400 uppercase tracking-tighter">Timeline</span>
                            <span class="text-slate-700">{{ $training->start_date ? $training->start_date->format('M d') : '??' }} - {{ $training->end_date ? $training->end_date->format('M d, Y') : '??' }}</span>
                        </div>
                        @if($training->score)
                        <div class="flex justify-between items-center text-[10px] font-bold">
                            <span class="text-slate-400 uppercase tracking-tighter">Assessment Score</span>
                            <span class="text-emerald-600">{{ $training->score }}%</span>
                        </div>
                        @endif
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex gap-2">
                        <a href="{{ route('hr-manager.trainings.edit', $training->id) }}" class="flex-1 py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-600 text-[9px] font-black uppercase tracking-widest rounded-xl text-center border border-slate-200 transition-all">
                            Adjust Program
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center bg-slate-50 border border-dashed border-slate-200 rounded-xl">
                    <div class="w-16 h-16 bg-slate-200 rounded-xl flex items-center justify-center text-slate-400 mx-auto mb-4">
                        <i data-lucide="book-open" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-slate-900 font-bold mb-1">No learning paths assigned.</h3>
                    <p class="text-slate-500 text-xs">Start by deploying a module from the course catalog.</p>
                </div>
                @endforelse
            </div>

            <!-- Skills Matrix Section -->
            <div class="mt-16">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-xl font-black text-emerald-600 tracking-widest uppercase">Professional Skill Matrix</h3>
                        <p class="text-slate-500 text-xs font-bold mt-1">Directly attributed competencies and proficiency levels.</p>
                    </div>
                    <button @click="$dispatch('open-modal', 'add-skill')" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 shadow-sm transition-all">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Add Competency
                    </button>
                </div>

                <div class="flex flex-wrap gap-4">
                    @forelse($employee->skills as $skill)
                    <div class="bg-white border border-slate-200 rounded-xl px-6 py-4 flex items-center gap-6 group hover:border-emerald-500/30 transition-all shadow-sm">
                        <div>
                            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ $skill->category ?? 'Skill' }}</div>
                            <div class="text-sm font-black text-slate-900">{{ $skill->name }}</div>
                        </div>
                        <div class="h-8 w-px bg-slate-100"></div>
                        <div class="flex items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <div class="w-1.5 h-4 rounded-full {{ $i <= $skill->pivot->proficiency ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>
                            @endfor
                        </div>
                        <form action="{{ route('hr-manager.employee-skills.destroy', $skill->pivot->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="opacity-0 group-hover:opacity-100 p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-all">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="w-full py-12 text-center bg-slate-50 border border-dashed border-slate-200 rounded-xl">
                        <p class="text-slate-400 text-xs font-black uppercase tracking-widest">No verified competencies on record.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<x-modal name="add-skill" title="Attribute Professional Skill">
    <form action="{{ route('hr-manager.employee-skills.store') }}" method="POST" class="p-6 space-y-4">
        @csrf
        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Select Competency</label>
            <select name="skill_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
                <option value="">Select Skill...</option>
                @foreach($allSkills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->name }} ({{ $skill->category }})</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">Proficiency (1-5)</label>
                <input type="number" name="proficiency" required min="1" max="5" value="1" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">Experience (Years)</label>
                <input type="number" name="years_of_experience" min="0" placeholder="e.g. 5" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
            </div>
        </div>
        <div class="pt-4 flex gap-3">
            <button type="button" @click="$dispatch('close')" class="flex-1 py-3 bg-slate-100 text-slate-700 font-bold rounded-xl transition-all border border-slate-200">Cancel</button>
            <button type="submit" class="flex-1 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-sm transition-all">Attribute Skill</button>
        </div>
    </form>
</x-modal>
<x-modal name="upload-document" title="Upload Document">
    <form action="{{ route('hr-manager.documents.store', ['employee_id' => $employee->id]) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Title</label>
            <input type="text" name="title" required placeholder="e.g. Contract 2025" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Type</label>
            <select name="type" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
                <option value="Contract">Employment Contract</option>
                <option value="ID">National ID / Passport</option>
                <option value="Certification">Professional Certification</option>
                <option value="Medical">Medical Records</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Expiry Date (Optional)</label>
            <input type="date" name="expiry_date" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Select File (PDF, Max 2MB)</label>
            <input type="file" name="file" required accept=".pdf" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-purple-600 file:text-white hover:file:bg-purple-700 shadow-sm">
        </div>
        <div class="pt-4 flex gap-3">
            <button type="button" @click="$dispatch('close')" class="flex-1 py-3 bg-slate-100 text-slate-700 font-bold rounded-xl transition-all border border-slate-200">Cancel</button>
            <button type="submit" class="flex-1 py-3 bg-purple-600 text-white font-bold rounded-xl shadow-sm transition-all">Upload</button>
        </div>
    </form>
</x-modal>

<x-modal name="add-contact" title="Add Emergency Contact">
    <form action="{{ route('hr-manager.emergency-contacts.store', ['employee_id' => $employee->id]) }}" method="POST" class="p-6 space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">Name</label>
                <input type="text" name="name" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">Relationship</label>
                <input type="text" name="relationship" required placeholder="e.g. Spouse" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">Phone</label>
                <input type="text" name="phone" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">Email</label>
                <input type="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600">
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Address</label>
            <textarea name="address" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 resize-none"></textarea>
        </div>
        <div class="flex items-center gap-3 bg-purple-50 p-4 rounded-xl border border-purple-100">
            <input type="checkbox" name="is_primary" value="1" id="is_primary" class="w-5 h-5 rounded border-slate-300 bg-white text-purple-600 focus:ring-0">
            <label for="is_primary" class="text-xs font-bold text-purple-600 cursor-pointer">Set as Primary Emergency Contact</label>
        </div>
        <div class="pt-4 flex gap-3">
            <button type="button" @click="$dispatch('close')" class="flex-1 py-3 bg-slate-100 text-slate-700 font-bold rounded-xl transition-all border border-slate-200">Cancel</button>
            <button type="submit" class="flex-1 py-3 bg-purple-600 text-white font-bold rounded-xl shadow-sm transition-all">Save Contact</button>
        </div>
    </form>
</x-modal>

@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        // Any specific logic for employee show page
    });
</script>
@endpush
