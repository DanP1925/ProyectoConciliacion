<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Conciliaci&oacute;n | Pontificia Universidad Cat&oacute;lica del Peru" />
    <meta name="author" content="PUCP - Ingeniería Informática" />

    <meta property="og:title" content="Conciliaci&oacute;n | Pontificia Universidad Cat&oacute;lica del Peru" />
    <meta property="og:site_name" content="Conciliaci&oacute;n | Pontificia Universidad Cat&oacute;lica del Peru" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <!--<meta property="og:url" content=" http://www.anestats.com" />
    <meta property="og:image" content="{{ asset('images/fbthumb200.png') }}" />-->
    <meta property="og:description" content="Sistema Web del Centro de Concilicaciones PUCP" />

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title') </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/site-fonts.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/foundation.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        // DESABILITAMOS LOS ERRORES DE "$ IS NOT A FUNCTION"
        // Colocamos los demas scripts debajo de esta linea
        var $ = jQuery.noConflict();
    </script>

</head>






<body class="site">
	
    
    @include('shared.header')
    
    <div class="site-content">
    	@yield('content')
	</div>
    
    @include('shared.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('js/vendor/what-input.js') }}"></script>
    <script src="{{ asset('js/vendor/foundation.min.js') }}"></script>
	@yield('scripts')
    <script>
        $(document).foundation();
    </script>
</body>
</html>
