<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('products', function($tabla){
            $tabla->increments('id');
            $tabla->integer('category_id')->unsigned();
            $tabla->string('product_name', 200);
            $tabla->double('price');
            $tabla->string('product_image',200);
            $tabla->text('description');
            $tabla->boolean('destacado');
            $tabla->timestamps();

            $tabla->foreign('category_id')->references('id')->on('categories');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('products');
	}

}
