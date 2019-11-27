<?php

namespace App;

use App\Departamento;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
	protected $table = 'empleados';

    protected $fillable = [
        'cui',
        'primer_nombre', 
        'segundo_nombre', 
        'primer_apellido',
        'segundo_apellido',
        'departamento_id',
        'cargo',
        'extension'
    ];

   	public function departamento()
   	{
   		return $this->belongsTo(Departamento::class);
   	}

    public function usuarios()
    {
      return $this->hasMany(User::class);
    }
}
