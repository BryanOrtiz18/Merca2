<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('proveedores', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('nombre_contacto'); // Campo obligatorio
        $table->string('email')->unique();
        $table->string('telefono');
        $table->string('direccion');
        $table->string('rtn')->nullable(); //RTN NICARAGUA
        $table->text('notas')->nullable();
        $table->boolean('activo')->default(true);
        $table->timestamps();
    });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
};