<?php

class CategoriasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$familias = Family::orderBy('family_name','asc')->get();
        $categorias = Category::paginate();
        return View::make('panel/categorias/listcategorias', compact('familias','categorias'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// retornar la vista de creacion en caso de que la haya
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $categoria = new Category;

        $data = Input::all();
        
        if ($categoria->isValid($data))
        {
            $categoria->family_id = $data['family_id'];
            $categoria->category_name = $data['category_name'];

            $categoria->save();

            return Redirect::route('panel.categorias.index');
        }
        else
        {
			return Redirect::route('panel.categorias.index')->withInput()->withErrors($categoria->errors);
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
		$familias = Family::orderBy('family_name','asc')->get();
		$categoria = Category::find($id);
		if (is_null ($categoria))
		{
			App::abort(404);
		}

		return View::make('panel/categorias/editcategorias')->with('categoria', $categoria)->with('familias', $familias);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $categoria = Category::find($id);
        
        // Si la categoría no existe entonces lanzamos un error 404 :(
        if (is_null ($categoria))
        {
            App::abort(404);
        }
        
        $data = Input::all();

        if ($categoria->validAndSave($data))
        {
            return Redirect::route('panel.categorias.index');
        }
        else
        {
            return Redirect::route('panel.categorias.edit', $categoria->id)->withInput()->withErrors($categoria->errors);
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
		$categoria = Category::find($id);
        
        if (is_null ($categoria))
        {
            App::abort(404);
        }
        
        $categoria->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Categoría ' . $categoria->category_name . ' eliminada',
                'id'      => $categoria->id
            ));
        }
        else
        {
            return Redirect::route('panel.categorias.index');
        }
	}


}
