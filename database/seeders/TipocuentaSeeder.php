<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipocuenta;

class TipocuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipocuenta::factory(20)->create();
    }
}
