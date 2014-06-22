<?php


class FamilyTableSeeder extends Seeder{

    public function run(){

        DB::table('families')->delete();

        Family::create([
            'family_name'   => 'Electrodomésticos'
        ]);

        Family::create([
            'family_name'   => 'Muebles'
        ]);
    }

} 