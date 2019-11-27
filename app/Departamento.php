<?php

namespace App;
use App\Empleado;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
	protected $table = 'departamentos';
	
    protected $fillable = [
        'nombre',
    ];

    public function empleados()
    {
    	return $this->hasMany(Empleado::class);
    }
}
