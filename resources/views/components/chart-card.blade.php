<div {{ $attributes->merge(['class' => 'chart-card']) }}>
    <div class="chart-header">
        <h3 class="chart-title">{{ $title }}</h3>
        @isset($actions)
        <div class="chart-actions">
            {{ $actions }}
        </div>
        @endisset
    </div>
    <div class="chart-content">
        {{ $slot }}
    </div>
</div>
