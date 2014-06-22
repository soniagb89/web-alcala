@extends('panel/layout')

@section('contenido-panel')
	<div class="page-header">
        <h3>Editar producto</h3>
    </div>
    <?php
        $arrayCombo = array();

        foreach($categorias as $categoria){
            $arrayCombo[$categoria->id] = $categoria->category_name;
        }
    ?>
    {{ Form::model($producto, array('route' => array('panel.productos.update', $producto->id), 'method' => 'PATCH','role' => 'form', 'class' => 'form-productos', 'files' => true)) }}

	  	@include ('panel/errors', array('errors' => $errors))

	    <div class="row">
		    <div class="form-group col-md-4">
		    	{{ Form::label('category_id', 'Categoría') }}
				{{ Form::select('category_id', $arrayCombo,$producto->category_id,array('class' => 'dropdown-familia form-control')) }}
		    </div>
		    <div class="form-group col-md-4">
	      		{{ Form::label('product_name', 'Nombre de producto') }}
                {{ Form::text('product_name', null, ['class' => 'form-control']) }}      
	    	</div>
	  	</div>

        <div class="row">
            <div class="form-group col-md-4">
                {{ Form::label('product_image', 'Imagen producto') }}<br>
                {{ Form::file('product_image', ['class' => 'btn btn-default', 'title' => 'Seleccionar imagen']) }}
                <span class="file-input-name">{{ $producto->product_image }}</span>
            </div>
            <div class="form-group col-md-4">
                {{ Form::label('price', 'Precio') }}
                <div class="input-group input-price">
                    {{ Form::text('price', null, ['class' => 'form-control']) }}
                    <span class="input-group-addon">€</span>
                </div>     
            </div> 
            
        </div>
        <div class="row">
            <div class="form-group col-md-4">   
                {{ Form::label('destacado', 'Producto destacado') }}
                {{ Form::checkbox('destacado', '1') }}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-8 col-sm-4">
                {{ Form::label('description', 'Descripción') }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'size' => '30x8']) }}
            </div>
        </div> 

	  	{{ Form::button('Actualizar', array('type' => 'submit', 'class' => 'btn btn-success')) }}
        <a href="{{ route('panel.productos.index') }}" class="btn btn-danger">Cancelar</a>

  	{{ Form::close() }}
@stop

@section('includes-js')
@parent
    {{ HTML::script('js/bootstrap.file-input.js')}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[type=file]').bootstrapFileInput();
        });
    </script>
@stop