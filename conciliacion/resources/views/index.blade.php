<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Conciliaciones PUCP | Pontificia Universidad Cat&oacute;lica del Per&uacute;</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/site-style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/site-fonts.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/foundation.css') }}" />
    </head>
    <body>
    	<div class="full-screen">
        	<div class="content">
            	<div class="grid-x">
                    <div class="small-8 medium-6 large-6 cell center-horizontally-div">
                    	<form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="login-box">
                                <div class="login-logo-div padding-bottom-10">
                                    <div class="grid-x">
                                        <div class="small-12 large-6 cell logo-left">
                                            <img src="{{ asset('images/logoConciliacion.png') }}" />
                                        </div>
                                        <div class="small-12 large-6 cell logo-right">
                                            <img src="{{ asset('images/logoPUCP1.png') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="login-line-div padding-bottom-20">
                                    <div class="login-label-div">
                                        Email
                                    </div>
                                    <div class="login-control-div">
                                        <div class="login-control-border-div">
                                            <input id="email" type="email" name="email" class="login-input" placeholder="Email" />
                                        </div>
                                    </div>
                                </div>
                                <div class="login-line-div padding-bottom-25">
                                    <div class="login-label-div">
                                        Contraseña
                                    </div>
                                    <div class="login-control-div">
                                        <div class="login-control-border-div">
                                            <input id="password" type="password" name="password" class="login-input" placeholder="Contraseña" />
                                        </div>
                                    </div>
                                </div>
                                <div class="login-line-div">
                                    <button type="submit" class="login-button">
                                    	Ingresar
                                    </button>
                                </div>
                            </div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/vendor/jquery.js') }}"></script>
        <script src="{{ asset('js/vendor/what-input.js') }}"></script>
        <script src="{{ asset('js/vendor/foundation.min.js') }}"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
