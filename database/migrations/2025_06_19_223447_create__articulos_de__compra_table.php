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
        Schema::create('_articulos_de__compra', function (Blueprint $table) {
            $table->id();
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
        Schema::create('detalle_compras', function (Blueprint $table) {

    $table->id();
    $table->foreignId('compra_id')->constrained('compras'); // Relación con tabla "compras"
    $table->foreignId('producto_id')->constrained('productos'); // Relación con tabla "productos"
    $table->integer('cantidad');
    $table->decimal('precio_unitario', 10, 2); // Precio en córdobas (NIO)
    $table->decimal('subtotal', 10, 2); // Subtotal en córdobas (NIO)
    $table->timestamps();

    });
    }
};
