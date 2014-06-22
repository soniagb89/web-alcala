<?php

class Product extends Eloquent{

    protected $table = 'products';
    protected $perPage = 5;
    protected $fillable = ['product_name', 'price'];

    public $errors;

    public function categories(){
        return $this->belongsTo('Category', 'category_id');
    }


    public function isValid($data)
    {
        $rules = array(
            'category_id' 	=> 'not_in:default|required',
            'product_name' 	=> 'required',
            'price' 		=> 'required'
        );

        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

} 