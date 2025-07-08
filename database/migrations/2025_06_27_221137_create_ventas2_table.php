<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('ruc')->nullable();
            $table->decimal('total', 15, 2); // aumentamos el tamaño
            $table->text('productos');
            $table->date('fecha');
            $table->enum('tipo_pago', ['Contado', 'Crédito'])->default('Contado');
            $table->string('vendedor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
