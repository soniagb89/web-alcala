<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de control Muebles y electrodomésticos Alcalá</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @section('includes-estilos')
    {{ HTML::style('bootstrap/css/bootstrap.css') }}
    {{ HTML::style('css/estilos-almacen.css') }}
    @show
</head>
<body>
    <div class="navbar navbar-default">
        <div class="navbar-container">
            <div class="navbar-header pull-left">
                <a class="navbar-brand2" >Muebles y electrodomésticos Alcalá</a>
            </div>
            <div class="pull-right botones-header">
                <div class="btn-group">
                    <a href="#" target="_blank" class="btn btn-info">
                        <span class="icon-earth"></span> Web
                    </a>

                </div>
                <div class="btn-group">
                    <a href="logout" class="btn btn-danger">
                        <span class="icon-switch"></span> Cerrar sesión
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div class="main-container-inner">
            <div class="sidebar list-group">
                {{ link_to('panel/categorias', 'Categorías',
                $attributes = array('class' => HTML::clever_linkPanel("panel/categorias"))) }}
                {{ link_to('panel/productos', 'Productos',
                $attributes = array('class' => HTML::clever_linkPanel("panel/productos"))) }}
            </div>
            <div class="main-content">
                <div class="page-content">
                    @yield('contenido-panel')
                </div>
            </div>
        </div>
    </div>

    @section('includes-js')
    {{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}
    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{-- Include all compiled plugins (below), or include individual files as needed --}}
    {{ HTML::script('bootstrap/js/bootstrap.min.js') }}
    {{ HTML::script('js/admin.js') }}
    @show

</body>
</html>

