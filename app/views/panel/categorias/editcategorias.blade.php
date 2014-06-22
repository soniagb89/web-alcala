@extends('panel/layout')

@section('contenido-panel')
	<div class="page-header">
        <h3>Editar categoría</h3>
    </div>
    <?php
        $arrayCombo = array();

        foreach($familias as $familia){
            $arrayCombo[$familia->id] = $familia->family_name;
        }
    ?>
    {{ Form::model($categoria, array('route' => array('panel.categorias.update', $categoria->id), 'method' => 'PATCH'), array('role' => 'form')) }}

	  	@include ('panel/errors', array('errors' => $errors))

	    <div class="row">
		    <div class="form-group col-md-4">
		    	{{ Form::label('family_id', 'Familia') }}
				{{ Form::select('family_id', $arrayCombo,$categoria->family_id,array('class' => 'dropdown-familia form-control')) }}
		    </div>
		    <div class="form-group col-md-4">
	      		{{ Form::label('category_name', 'Categoría') }}    
	      		{{ Form::text('category_name', null, ['class' => 'form-control', 'id' => 'categoria'] ) }}        
	    	</div>
	  	</div>

	  	{{ Form::button('Actualizar categoría', array('type' => 'submit', 'class' => 'btn btn-success')) }}

  	{{ Form::close() }}
@stop