<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">
    <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">{{ __('Home') }} <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        @auth
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                    <a class="nav-link" href="{{route('admin.stores.index')}}">{{ __('Stores') }} <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                    <a class="nav-link" href="{{route('admin.products.index')}}">{{ __('Products') }}</a>
                </li>
                <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">{{ __('Categories') }}</a>
                </li>
            </ul>
        @endauth

        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li>
                    @if(session()->has('cart'))
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <span class="badge badge-danger">
{{--                                {{ array_sum(array_column(session()->get('cart'), 'amount')) }}--}}
                                {{ count(session()->get('cart')) }}
                            </span>
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @include('flash::message')
    @yield('content')
</div>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

@yield('scripts')
</body>
</html>
