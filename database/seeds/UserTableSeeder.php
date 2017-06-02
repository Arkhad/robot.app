<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                [
                        'name' => 'ak',
                        'email' => 'ak@gmail.com',
                        'password' => bcrypt('secret'),
                        'role' => 'administrator',
                ],
                [
                        'name' => 'coco',
                        'email' => 'coco-soleil@gmail.com',
                        'password' => bcrypt('secret'),
                        'role' => 'editor',   
                ],
                [
                        'name' => 'rockette',
                        'email' => 'rockette929@gmail.com',
                        'password' => bcrypt('secret'),
                        'role' => 'editor',   
                ],
        ]);
    }
}
