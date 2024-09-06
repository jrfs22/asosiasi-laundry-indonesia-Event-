@props(['main', 'current', 'route'])

<div class="card bg-green-soft shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <h4 class="fw-semibold mb-8">{{ $current }}</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ $route }}">{{ $main }}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{ $current }}</li>
            </ol>
        </nav>
    </div>
</div>
