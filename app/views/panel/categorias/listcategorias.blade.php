@extends('panel/layout')

@section('contenido-panel')
	<div class="page-header">
        <h3>Categorías</h3>
    </div>
    <?php
        $arrayCombo = array('default' => '- Seleccione familia -'  );

        foreach($familias as $familia){
            $arrayCombo[$familia->id] = $familia->family_name;
        }
    ?>
    {{ Form::model($categorias, array('route' => 'panel.categorias.store', 'method' => 'POST','role' => 'form', 'class' => 'form-categorias')) }}

	  	@include ('panel/errors', array('errors' => $errors))

	    <div class="row">
		    <div class="form-group col-md-4">
		    	{{ Form::label('family_id', 'Familia') }}
				{{ Form::select('family_id', $arrayCombo,'default',array('class' => 'dropdown-familia form-control')) }}
		    </div>
		    <div class="form-group col-md-4">
	      		{{ Form::label('category_name', 'Categoría') }}    
	      		{{ Form::text('category_name', null, ['class' => 'form-control', 'id' => 'categoria'] ) }}        
	    	</div>
	  	</div>

	  	{{ Form::button('Crear categoría', array('type' => 'submit', 'class' => 'btn btn-success')) }}

  	{{ Form::close() }}

    @if(count($categorias) != 0)

    <table class="table table-striped table-categorias">
	    <tr>
	        <th>Familia</th>
            <th>Categoría</th>
	        <th>Acciones</th>
	    </tr>
        @foreach($categorias as $cat)
        <tr>
            <td>{{ $cat->families->family_name }}</td>
            <td>{{ $cat->category_name }}</td>
            <td>
                <a href="#" data-id="{{ $cat->id }}" class="btn btn-danger btn-sm btn-delete">
		            <span class="icon-remove"></span> Eliminar
	            </a>
                <a href="{{ route('panel.categorias.edit', $cat->id) }}" class="btn btn-info btn-sm">
                	<span class="icon-pencil"></span> Editar
          		</a>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $categorias->links() }}

    @endif


    {{ Form::open(array('route' => array('panel.categorias.destroy', 'CATEGORY_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
	{{ Form::close() }}
@stop