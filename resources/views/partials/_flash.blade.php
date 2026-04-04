@php
    $flashMessages = [
        'success' => 'success',
        'danger' => 'danger',
        'warning' => 'warning',
    ];
@endphp

@foreach ($flashMessages as $key => $alertClass)
    @if (session($key))
        <div class="alert alert-{{ $alertClass }} alert-dismissible fade show" role="alert">
            {{ session($key) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach
