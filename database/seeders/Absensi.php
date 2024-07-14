<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Absensi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('absensi')->insert([
            [
                'id' => 1,
                'tanggal' => "2024-07-01",
            ],
            [
                'id' => 2,
                'tanggal' => "2024-07-02",
            ],
            [
                'id' => 3,
                'tanggal' => "2024-07-03",
            ],
            [
                'id' => 4,
                'tanggal' => "2024-07-04",
            ],
            [
                'id' => 5,
                'tanggal' => "2024-07-05",
            ],
            [
                'id' => 6,
                'tanggal' => "2024-07-06",
            ],
            [
                'id' => 7,
                'tanggal' => "2024-07-07",
            ],
            [
                'id' => 8,
                'tanggal' => "2024-07-08",
            ],
            [
                'id' => 9,
                'tanggal' => "2024-07-09",
            ],
            [
                'id' => 10,
                'tanggal' => "2024-07-10",
            ],
            [
                'id' => 11,
                'tanggal' => "2024-07-11",
            ],
            [
                'id' => 12,
                'tanggal' => "2024-07-12",
            ],
            [
                'id' => 13,
                'tanggal' => "2024-07-13",
            ],
            [
                'id' => 14,
                'tanggal' => "2024-07-14",
            ],
            // [
            //     'id' => 15,
            //     'tanggal' => "2024-07-15",
            // ],
            // [
            //     'id' => 16,
            //     'tanggal' => "2024-07-16",
            // ],
            // [
            //     'id' => 17,
            //     'tanggal' => "2024-07-17",
            // ],
            // [
            //     'id' => 18,
            //     'tanggal' => "2024-07-18",
            // ],
            // [
            //     'id' => 19,
            //     'tanggal' => "2024-07-19",
            // ],
            // [
            //     'id' => 20,
            //     'tanggal' => "2024-07-20",
            // ],
            // [
            //     'id' => 21,
            //     'tanggal' => "2024-07-21",
            // ],
            // [
            //     'id' => 22,
            //     'tanggal' => "2024-07-22",
            // ],
            // [
            //     'id' => 23,
            //     'tanggal' => "2024-07-23",
            // ],
            // [
            //     'id' => 24,
            //     'tanggal' => "2024-07-24",
            // ],
            // [
            //     'id' => 25,
            //     'tanggal' => "2024-07-25",
            // ],
            // [
            //     'id' => 26,
            //     'tanggal' => "2024-07-26",
            // ],
            // [
            //     'id' => 27,
            //     'tanggal' => "2024-07-27",
            // ],
            // [
            //     'id' => 28,
            //     'tanggal' => "2024-07-28",
            // ],
            // [
            //     'id' => 29,
            //     'tanggal' => "2024-07-29",
            // ],
            // [
            //     'id' => 30,
            //     'tanggal' => "2024-07-30",
            // ],
            // [
            //     'id' => 31,
            //     'tanggal' => "2024-07-31",
            // ],
            // [
            //     'id' => 32,
            //     'tanggal' => "2024-08-01",
            // ],
            // [
            //     'id' => 33,
            //     'tanggal' => "2024-08-02",
            // ],
            // [
            //     'id' => 34,
            //     'tanggal' => "2024-08-03",
            // ],
            // [
            //     'id' => 35,
            //     'tanggal' => "2024-08-04",
            // ],
            // [
            //     'id' => 36,
            //     'tanggal' => "2024-08-05",
            // ],
            // [
            //     'id' => 37,
            //     'tanggal' => "2024-08-06",
            // ],
            // [
            //     'id' => 38,
            //     'tanggal' => "2024-08-07",
            // ],
            // [
            //     'id' => 39,
            //     'tanggal' => "2024-08-08",
            // ],
            // [
            //     'id' => 40,
            //     'tanggal' => "2024-08-09",
            // ],
            // [
            //     'id' => 41,
            //     'tanggal' => "2024-08-10",
            // ],
            // [
            //     'id' => 42,
            //     'tanggal' => "2024-08-11",
            // ],
            // [
            //     'id' => 43,
            //     'tanggal' => "2024-08-12",
            // ],
            // [
            //     'id' => 44,
            //     'tanggal' => "2024-08-13",
            // ],
            // [
            //     'id' => 45,
            //     'tanggal' => "2024-08-14",
            // ],
            // [
            //     'id' => 46,
            //     'tanggal' => "2024-08-15",
            // ],
            // [
            //     'id' => 47,
            //     'tanggal' => "2024-08-16",
            // ],
            // [
            //     'id' => 48,
            //     'tanggal' => "2024-08-17",
            // ],
            // [
            //     'id' => 49,
            //     'tanggal' => "2024-08-18",
            // ],
            // [
            //     'id' => 50,
            //     'tanggal' => "2024-08-19",
            // ],
            // [
            //     'id' => 51,
            //     'tanggal' => "2024-08-20",
            // ],
            // [
            //     'id' => 52,
            //     'tanggal' => "2024-08-21",
            // ],
            // [
            //     'id' => 53,
            //     'tanggal' => "2024-08-22",
            // ],
            // [
            //     'id' => 54,
            //     'tanggal' => "2024-08-23",
            // ],
            // [
            //     'id' => 55,
            //     'tanggal' => "2024-08-24",
            // ],
            // [
            //     'id' => 56,
            //     'tanggal' => "2024-08-25",
            // ],
            // [
            //     'id' => 57,
            //     'tanggal' => "2024-08-26",
            // ],
            // [
            //     'id' => 58,
            //     'tanggal' => "2024-08-27",
            // ],
            // [
            //     'id' => 59,
            //     'tanggal' => "2024-08-28",
            // ],
            // [
            //     'id' => 60,
            //     'tanggal' => "2024-08-29",
            // ],
            // [
            //     'id' => 61,
            //     'tanggal' => "2024-08-30",
            // ],
            // [
            //     'id' => 62,
            //     'tanggal' => "2024-08-31",
            // ],
        ]);
    }
}
