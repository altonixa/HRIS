<div {{ $attributes->merge(['class' => 'activity-feed']) }}>
    <h3 class="text-lg font-bold text-white mb-4">{{ $title ?? 'Recent Activity' }}</h3>
    <div class="space-y-0">
        {{ $slot }}
    </div>
</div>

{{-- Usage example in slot:
<div class="activity-item">
    <div class="activity-icon" style="background: rgba(34, 197, 94, 0.1); color: var(--success);">
        <i data-lucide="check-circle" class="w-4 h-4"></i>
    </div>
    <div class="activity-content">
        <div class="activity-title">Leave Approved</div>
        <div class="activity-description">John Doe's leave request was approved</div>
        <div class="activity-time">2 hours ago</div>
    </div>
</div>
--}}
