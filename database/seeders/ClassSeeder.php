<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
                [
                    'name' => 'Child/Play',
                    'number' => 0,
                ],
                [
                    'name' => 'One',
                    'number' => 1,
                ],
                [
                    'name' => 'Two',
                    'number' => 2,
                ],
                [
                    'name' => 'Three',
                    'number' => 3,
                ],
                [
                    'name' => 'Four',
                    'number' => 4,
                ],
                [
                    'name' => 'Five',
                    'number' => 5,
                ],
                [
                    'name' => 'Six',
                    'number' => 6,
                ],
                [
                    'name' => 'Seven',
                    'number' => 7,
                ],
                [
                    'name' => 'Eight',
                    'number' => 8,
                ],
                [
                    'name' => 'Nine',
                    'number' => 9,
                ],
                [
                    'name' => 'Ten',
                    'number' => 10,
                ],
                [
                    'name' => 'Eleven',
                    'number' => 11,
                ],
                [
                    'name' => 'Twelve',
                    'number' => 12,
                ],
                [
                    'name' => 'Honors/Degree/Fazil',
                    'number' => 13,
                ],
                [
                    'name' => 'Masters/Kamil',
                    'number' => 14,
                ],
                [
                    'name' => 'Others',
                    'number' => 15,
                ]

        ]);
    }
}
