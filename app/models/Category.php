<?php


class Category extends Eloquent{

    protected $table = 'categories';
    protected $perPage = 5;
    protected $fillable = ['category_name'];

    public $errors;

    public function families(){
        return $this->belongsTo('Family', 'family_id');
    }

    public function products(){
        return $this->hasMany('Product');
    }

    public function isValid($data)
    {
        $rules = array(
            'category_name' => 'required|unique:categories',
            'family_id' 	=>	'not_in:default|required'
        );

        // Si la categoria existe:
        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta la categoria actual
			$rules['category_name'] .= ',category_name,' . $this->id;
        }
                
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function validAndSave($data)
    {
        // Revisamos si la data es válida
        if ($this->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            //$this->fill($data);
            $this->family_id = $data['family_id'];
            $this->category_name = $data['category_name'];
            // Guardamos el usuario
            $this->save();
            
            return true;
        }
        
        return false;
    }

} 