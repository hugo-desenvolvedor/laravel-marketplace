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
            <li class="nav-item @if(request()->is('home')) active @endif">
                <a class="nav-link" href="{{route('home')}}">{{ __('Home') }} <span class="sr-only">(current)</span></a>
            </li>

            @foreach($categories as $category)
                <li class="nav-item @if(request()->is(sprintf('category/%s', $category->slug))) active @endif">
                    <a class="nav-link"
                       href="{{ route('category.single', ['slug' => $category->slug]) }}">{{ __($category->name) }}
                        <span class="sr-only">(current)</span></a>
                </li>
            @endforeach
        </ul>

        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('my-orders')) active @endif">
                    <a href="{{ route('user.orders') }}" class="nav-link">{{ __('My Orders') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="nav-link">
                        @if(session()->has('cart'))
                            <span class="badge badge-danger">
{{--                                {{ array_sum(array_column(session()->get('cart'), 'amount')) }}--}}
                                {{ count(session()->get('cart')) }}
                            </span>
                        @endif
                        <i class="fa fa-shopping-cart"></i>
                    </a>
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
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!-- Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
        integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
        crossorigin="anonymous"></script>

@yield('scripts')
</body>
</html>
