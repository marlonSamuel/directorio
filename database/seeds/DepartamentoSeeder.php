<?php

use App\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = new Departamento;
       $data->nombre = 'Informatica';
       $data->save();
    }
}
