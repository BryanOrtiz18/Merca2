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
        Schema::create('compras', function (Blueprint $table) {
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
        Schema::create('compras', function (Blueprint $table) {

    $table->id();
    $table->foreignId('proveedor_id')->constrained('proveedores'); // Relación con tabla "proveedores"
    $table->foreignId('usuario_id')->constrained('users'); // Relación con tabla "users"
    $table->date('fecha_compra');
    $table->string('numero_factura')->unique();
    $table->decimal('total', 10, 2); // Monto en córdobas (asumiendo formato decimal estándar)
    $table->enum('estado', ['pendiente', 'recibido', 'cancelado'])->default('pendiente');
    $table->text('observaciones')->nullable(); // "Notas" se cambia a "observaciones" (más común en documentos formales)
    $table->timestamps();
    
    });
    }
};
