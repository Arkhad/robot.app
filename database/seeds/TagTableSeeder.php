<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
                [
                        'name' => 'army',

                ],
                [
                        'name' => 'medical',

                ],
                [
                        'name' => 'techno',

                ],
        ]);
    }
}
