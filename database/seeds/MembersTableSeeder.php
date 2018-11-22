<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // group one
        DB::table('members')->insert([
            'name' => 'Alex',
            'group_id' => 1,
            'user_id' => 1,
            'type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('members')->insert([
            'name' => 'Zach',
            'group_id' => 1,
            'user_id' => 2,
            'type' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('members')->insert([
            'name' => 'Sam',
            'group_id' => 1,
            'user_id' => 3,
            'type' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // Second member for user
        DB::table('members')->insert([
            'name' => 'Tony',
            'group_id' => 1,
            'user_id' => 1,
            'type' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // group 2
        DB::table('members')->insert([
            'name' => 'Alex',
            'group_id' => 2,
            'user_id' => 1,
            'type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
