<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'slug' => 'user',
            'name' => 'User',
            'permissions' => '{"users":1}',
        ]);

        DB::table('roles')->insert([
            'slug' => 'admin',
            'name' => 'Admin',
            'permissions' => '{"admins":1, "users":1}',
        ]);
    }
}