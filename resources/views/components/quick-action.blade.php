@props(['href' => '#', 'icon', 'iconBg' => 'rgba(139, 92, 246, 0.1)', 'iconColor' => 'var(--primary)'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'quick-action']) }}>
    <div class="quick-action-icon" style="background: {{ $iconBg }}; color: {{ $iconColor }};">
        <i data-lucide="{{ $icon }}" class="w-4 h-4"></i>
    </div>
    <span class="quick-action-text">{{ $slot }}</span>
</a>
