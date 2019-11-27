<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('departamento_id');
            $table->string('cui',25);
            $table->string('primer_nombre',50);
            $table->string('segundo_nombre',50)->nullable();
            $table->string('primer_apellido',50);
            $table->string('segundo_apellido',50)->nullable();
            $table->string('extension',50);
            $table->string('cargo',50);

            $table->timestamps();

            $table->foreign('departamento_id')->references('id')->on('departamentos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
