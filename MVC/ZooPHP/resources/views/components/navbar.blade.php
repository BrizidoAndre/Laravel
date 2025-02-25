@php
    $currentRoute = Route::getCurrentRoute()->uri;
@endphp

<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom px-3">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">ZooPHP</span>
    </a>



    <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ $currentRoute === 'users' ? 'active' : '' }}">
                Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('animals.index') }}" class="nav-link {{ $currentRoute === 'animals' ? 'active' : '' }}">
                Animais
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.create') }}" class="nav-link {{ $currentRoute === 'users/create' ? 'active' : '' }}">
                Cadastrar
            </a>
        </li>
        <li class="nav-item"><a href="" class="nav-link">Login</a></li>
    </ul>
</header>
