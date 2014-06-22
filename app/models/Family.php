<?php

class Family extends Eloquent {

    protected $table = 'families';
    public $timestamps = false;
    protected $fillable = ['id', 'family_name'];

    public function categories(){
        return $this->hasMany('Category');
    }

}