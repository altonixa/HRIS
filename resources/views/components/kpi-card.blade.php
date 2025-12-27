<div {{ $attributes->merge(['class' => 'kpi-card']) }}>
    <div class="kpi-icon" style="background: {{ $iconBg ?? 'rgba(139, 92, 246, 0.1)' }}; color: {{ $iconColor ?? 'var(--primary)' }};">
        <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
    </div>
    <div class="kpi-content">
        <div class="kpi-label">{{ $label }}</div>
        <div class="kpi-value">{{ $value }}</div>
        @isset($change)
        <div class="kpi-change {{ $changeType ?? 'positive' }}">
            {{ $change }}
        </div>
        @endisset
    </div>
</div>
