@props(['difficulty'])

@php
    $level = strtolower((string) $difficulty);
    $label = ucfirst($level);

    $classes = match ($level) {
        'easy' => 'bg-success text-white',
        'medium' => 'text-white',
        'hard' => 'bg-danger text-white',
        default => 'bg-secondary text-white',
    };

    $style = $level === 'medium' ? 'background-color: #fd7e14;' : '';
@endphp

<span {{ $attributes->merge(['class' => 'badge text-capitalize ' . $classes, 'style' => $style]) }}>
    {{ $label }}
</span>
