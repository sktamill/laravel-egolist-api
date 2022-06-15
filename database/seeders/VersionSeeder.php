<?php

namespace Database\Seeders;

use App\Models\Version;
use Illuminate\Database\Seeder;


class VersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Version::factory()->createMany([
           ['title' => '8.1', 'release_date' => '2022-05-18'],
           ['title' => '8.2', 'release_date' => '2022-05-19'],
           ['title' => '8.3', 'release_date' => '2022-05-20'],
           ['title' => '8.4', 'release_date' => '2022-05-21'],
           ['title' => '8.5', 'release_date' => '2022-05-22'],
           ['title' => '8.6', 'release_date' => '2022-05-23'],
        ]);
    }
}
