<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Christmas List and Secret Santa Organizer">
    <meta name="author" content="Alex Mayer">

    <title>@yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('inc.header')

    <main class="container py-4" role="main">
        @hasSection('breadcrumbs')
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumbs')
                </ol>
            </nav>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    @include('inc.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
