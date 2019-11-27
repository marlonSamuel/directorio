<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new User;
        $data->email = 'admin@admin.com';
        $data->password = bcrypt('secret');
        $data->empleado_id = 1;
        $data->save();
    }
}
