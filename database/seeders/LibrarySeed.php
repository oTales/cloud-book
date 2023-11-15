<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrarySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Library::factory(10)->create();
    }
}
