@extends('panel/layout')

@section('contenido-panel')
	<div class="page-header">
        <h3>Productos</h3>
    </div>

    <a href="{{ route('panel.productos.create') }}" class="btn btn-success">Crear un nuevo producto</a>

    @if(count($productos) != 0)

    <table class="table table-striped table-productos">
	    <tr>
	        <th>Categoría</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Imagen producto</th>
            <th>Producto destacado</th>
            <th>Acciones</th>
	    </tr>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->categories->category_name }}</td>
            <td>{{ $producto->product_name }}</td>
            <td>{{ $producto->price }} €</td>
            <td>{{ $producto->product_image }}</td>
            <td>
                @if($producto->destacado == 1)
                    <span class="glyphicon glyphicon-ok color-ok"></span>
                @else
                    <span class="glyphicon glyphicon-remove color-remove"></span>
                @endif
            </td>
            <td>
                <a href="#" data-id="{{ $producto->id }}" class="btn btn-danger btn-sm btn-delete">
		            <span class="icon-remove"></span> Eliminar
	            </a>
                <a href="{{ route('panel.productos.edit', $producto->id) }}" class="btn btn-info btn-sm">
                	<span class="icon-pencil"></span> Editar
          		</a>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $productos->links() }}

    @endif


    {{ Form::open(array('route' => array('panel.productos.destroy', 'CATEGORY_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
	{{ Form::close() }}
@stop