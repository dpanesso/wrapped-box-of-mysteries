<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => 'Test Group',
            'description' => "This is a group\r\nfor testing\r\nthings",
            'invite_code' => md5(str_random(10)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('groups')->insert([
            'name' => 'Lonely Group',
            'description' => 'There should only be one user in this group',
            'invite_code' => md5(str_random(10)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
