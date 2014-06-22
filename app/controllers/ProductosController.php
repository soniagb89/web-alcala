<?php

class ProductosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $productos = Product::paginate();
        return View::make('panel/productos/listproductos', compact('productos'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categorias = Category::orderBy('category_name','asc')->get();
		$productos = Product::all();
      	return View::make('panel/productos/createproducto')->with('categorias', $categorias)->with('productos', $productos);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$producto = new Product;

        $data = Input::all();
        
        if ($producto->isValid($data))
        {
        	$imagen_producto = $data['product_image']->getClientOriginalName();

            $producto->category_id = $data['category_id'];
            $producto->product_name = $data['product_name'];
            $producto->price = $data['price'];
            $producto->product_image = $imagen_producto;
            $producto->description = $data['description'];

            if(!isset($data['destacado'])) {
            	$data['destacado'] = 0;
            }
            $producto->destacado = $data['destacado'];

            $producto->save();

            $data["product_image"]->move('almacen', $imagen_producto);

            return Redirect::route('panel.productos.index');
        }
        else
        {
			return Redirect::route('panel.productos.create')->withInput()->withErrors($producto->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$categorias = Category::orderBy('category_name','asc')->get();
		$producto = Product::find($id);
      	
		if (is_null ($producto))
		{
			App::abort(404);
		}
		return View::make('panel/productos/editproducto')->with('producto', $producto)->with('categorias', $categorias);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$producto = Product::find($id);
        
        // Si la categoría no existe entonces lanzamos un error 404 :(
        if (is_null ($producto))
        {
            App::abort(404);
        }
        
        $data = Input::all();

        if ($producto->isValid($data))
        {
        	$imagen_producto = NULL;
        	$imagen_anterior = NULL;

        	if(isset($data['product_image'])){
        		$imagen_producto = $data['product_image']->getClientOriginalName();
        		$imagen_anterior = $producto->product_image;
        		$producto->product_image = $imagen_producto;
        	}        	

            $producto->category_id = $data['category_id'];
            $producto->product_name = $data['product_name'];
            $producto->price = $data['price'];            
            $producto->description = $data['description'];

            if(!isset($data['destacado'])) {
            	$data['destacado'] = 0;
            }
            $producto->destacado = $data['destacado'];

            $producto->save();

            // si existe la variable $imagen_producto significa que se ha modificado la imagen del producto
            // por lo que eliminamos la imagen antigua de la carpeta y subimos la nueva.

            if(isset($imagen_producto)){

            	//busco si existe una imagen con el mismo nombre en la base de datos
            	// si existe no la elimino de la carpeta
            	$imagenes = Product::lists('product_image');

            	$flag = true;
            	foreach ($imagenes as $img) {
            		if($img == $imagen_anterior){
            			$flag = false;
            		}
            	}

            	if($flag) {
            		$destinationPath = 'almacen/';
		    		File::delete($destinationPath . $imagen_anterior);
            	}

		    	$data["product_image"]->move('almacen', $imagen_producto);
            }

            return Redirect::route('panel.productos.index');
        }
        else
        {
			return Redirect::route('panel.productos.edit')->withInput()->withErrors($producto->errors);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$producto = Product::find($id);
        
        if (is_null ($producto))
        {
            App::abort(404);
        }
        
        $destinationPath = 'almacen/';
		File::delete($destinationPath . $producto->product_image);

		$producto->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Producto ' . $producto->product_name . ' eliminado',
                'id'      => $producto->id
            ));
        }
        else
        {
            return Redirect::route('panel.productos.index');
        }
	}


}
