<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user_ids = DB::table('users')->pluck('id');
        $product_ids = DB::table('products')->pluck('id');
        $number_of_products = rand(0, 5);
        $user_index = rand(0, count($user_ids)-1);

        $id = DB::table('orders')->insertGetId([
            'user_id' => $user_ids[$user_index],
            'total_price' => rand(0.1,100)
        ]);

        for ($i = 0; $i< $number_of_products ; $i++){
            DB::table('order_products')->insert([
                'order_id' => $id,
                'product_id' => $product_ids[rand(0, count($product_ids)-1)],
                'unit' => rand(1,10)
            ]);
        }
    }
}
