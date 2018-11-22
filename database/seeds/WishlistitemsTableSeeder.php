<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WishlistitemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wishlistitems')->insert([
            'member_id' => 1,
            'description' => 'Arch T-Shirt',
            'price' => '$20',
            'link' => 'https://www.amazon.com/Zazzle-Linux-T-Shirt-White-Adult/dp/B07JWP962P',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('wishlistitems')->insert([
            'member_id' => 2,
            'description' => 'Fun Size Starbursts',
            'price' => '$4',
            'link' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
