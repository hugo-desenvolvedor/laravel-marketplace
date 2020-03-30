<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel MarketPlace</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">Marketplace </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
@auth
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('home')) active @endif ">
                <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
            </li>
            <li class="nav-item @if(request()->is('admin/stores*')) active @endif ">
                <a class="nav-link" href="{{ route('admin.stores.index') }}">{{ __('Stores') }}</a>
            </li>
            <li class="nav-item @if(request()->is('admin/products*')) active @endif ">
                <a class="nav-link" href="{{ route('admin.products.index') }}">{{ __('Products') }}</a>
            </li>
            <li class="nav-item @if(request()->is('admin/categories*')) active @endif ">
                <a class="nav-link" href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="my-2 my-lg-0">
            <div class="nav-item">
                <a href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit()" class="nav-link">{{ __('Logout') }}</a>
                <form action="{{ route('logout') }}" class="logout" method="POST" style="display:none">
                    @csrf
                </form>
            </div>
        </div>
@endauth
    </div>
</nav>
<div class="container">
    @include('flash::message')
    @yield('content')
</div>
</body>
</html>
