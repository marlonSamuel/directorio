<?php

use App\Empleado;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Empleado();
        $data->cui = '124578965425';
        $data->primer_nombre = 'marlon';
        $data->primer_apellido = 'gonzalez';
        $data->departamento_id = 1;
        $data->cargo = 'Jefe informatica';
        $data->extension = '5567';
        $data->save();

        $data = new Empleado();
        $data->cui = '781245369875';
        $data->primer_nombre = 'Gabriela';
        $data->primer_apellido = 'Gaitan';
        $data->departamento_id = 1;
        $data->cargo = 'Asistente de informatica';
        $data->extension = '5568';
        $data->save();
    }
}
