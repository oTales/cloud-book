<?php

namespace Database\Seeders;

use App\Models\RentBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentBookSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RentBook::factory(10)->create();
    }
}
