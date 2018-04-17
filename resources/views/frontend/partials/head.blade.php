<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="{{ asset('/vendor/ace/assets/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/sweetalert.min.css') }}">

<!-- Styles -->
<link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="/css/style4.css" rel="stylesheet" type="text/css" media="all" />

@yield('styles')

@yield('inline_styles')

<script src='/vendor/ace/assets/js/jquery.js'></script>

<!-- Scripts -->
<script>
    window.csrf = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>

<script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
        }, false);
    function hideURLbar(){
        window.scrollTo(0,1);
    }
</script>
