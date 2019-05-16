<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Painel Administrativo">

    <link rel="stylesheet" href="{{ url('css/app.css')}}">

    <title>{{ config('app.name') }}</title>
</head>
<body class="d-flex align-items-center bg-white border-top-2 border-primary">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-5 col-lg-6 col-xl-4 px-lg-6 my-5">
                <h1 class="display-4 text-center mb-4">
                    <img src="{{url('img/logo.png')}}" class="mx-auto" alt="..." width="100%" height="100%">
                </h1>
                <p class="text-muted text-center mb-5">
                    Acesse seu painel administrativo
                </p>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                {!! Form::open(['method' => 'post', 'route' => ['authenticate']]) !!}
                    {!! Form::openGroup('email', 'E-mail') !!}
                    {!! Form::text('email', null, ['placeholder' => 'nome@email.com']) !!}
                    {!! Form::closeGroup() !!}
                    {!! Form::openGroup('password', 'Senha') !!}
                    {!! Form::password('password', ['placeholder' => 'Sua senha']) !!}
                    {!! Form::closeGroup() !!}
                    <button class="btn btn-lg btn-block btn-primary mb-3">
                        Entrar
                    </button>
                {!! Form::close() !!}
            </div>
            <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">
                <div class="bg-cover vh-100 mt--1 mr--3" style="background-image: url({{url('img/covers/auth-side-cover.jpg')}});"></div>
            </div>
        </div>
    </div>
    <script src="{{ url('js/app.js')}}"></script>
</body>
</html>
