<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    {{ HTML::style('bootstrap/css/bootstrap.css') }}
    {{ HTML::style('css/estilos-almacen.css') }}
</head>

<body class="body_login">

    <div class="container-all">
        <div class="header-title">
            <h3>Muebles y <br> Electrodomésticos <br> Alcalá</h3>
        </div>
        {{ Form::model(['route' => 'panel.categorias.index', 'method' => 'post', 'role' => 'form']) }}

        <div class="input-group">
            <span class="input-group-addon">
                <span class="icon-user"></span>
            </span>
            {{ Form::text('username', null, ['class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => 'Usuario']) }}
        </div>
        <br>

        <div class="input-group">
            <span class="input-group-addon">
                <span class="icon-key"></span>
            </span>
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) }}
        </div>
        <br>
        @if(Session::has('login_error'))
            <div class="alert alert-danger">
                <strong>{{ Session::get('login_error') }}</strong>
            </div>
        @endif

        <input type="submit" value="Acceder" class="btn btn-warning  btn-block"/>

        {{ Form::close() }}
    </div>

</body>
</html>