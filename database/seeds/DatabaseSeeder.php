<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// use Sentinel;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // SEEDER OFFRES
        DB::table('offres')->insert([
            'title' => '7 Days',
            'price' => '7',
            'nb_days' => '7'
        ]);

        DB::table('offres')->insert([
            'title' => '30 Days',
            'price' => '15',
            'nb_days' => '30'
        ]);

        // SEEDER ROLES
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

        // SEEDER USER ADMIN
        $user = [
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'first_name' => 'Admin',
            'last_name' => 'Istrator'
        ];

        Sentinel::registerAndActivate($user);

        // SEEDER ROLES USER ADMIN
        DB::table('role_users')->insert([
            'user_id' => '1',
            'role_id' => '2'
        ]);

        // SEEDER STATIONS
        $key = md5(microtime().rand());
        DB::table('stations')->insert([
            'name' => 'Gare du Nord',
            'location' => '{"lat":"48.8809481","lng":"2.3553137000000106"}',
            'description' => 'Gare du Nord, Rue de Dunkerque, Paris, France',
            'key' => $key,
            'valid' => 1
        ]);

        $key = md5(microtime().rand());
        DB::table('stations')->insert([
            'name' => 'Gare de Lyon',
            'location' => '{"lat":"48.84430380000001","lng":"2.374377299999992"}',
            'description' => 'Gare de Lyon, Place Louis Armand, Paris, France',
            'key' => $key,
            'valid' => 1
        ]);

        $key = md5(microtime().rand());
        DB::table('stations')->insert([
            'name' => 'Gare Saint-Lazare',
            'location' => '{"lat":"48.87665399999999","lng":"2.325266000000056"}',
            'description' => 'Gare Saint-Lazare, Paris, France',
            'key' => $key,
            'valid' => 1
        ]);

        Model::reguard();
    }
}
