<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $typeRand = rand(0, 1);
        $type = "product";
        if ($typeRand){
            $type = "normal";
        }else{
            $type = "sale";
        }
        $id = DB::table('products')->insertGetId([
            'name' => str_random(20),
            'price' => rand(0, 1000),
            'image_path' => str_random(20),
            'type' => $type,
        ]);
        if($typeRand){
            DB::table('normal_items')->insert(['id'=>$id,]);
        }else{
            DB::table('sale_items')->insert([
                'id'=>$id,
                'new_price' => rand(0, 1000),
            ]);
        }
    }
}
