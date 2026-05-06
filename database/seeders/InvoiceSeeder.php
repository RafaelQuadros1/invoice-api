<?php

namespace Database\Seeders;

use Database\Factories\InvoiceFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvoiceFactory::new()->count(10)->create();
    }
}
