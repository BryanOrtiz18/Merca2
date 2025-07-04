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
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('barcode')->unique();
        $table->decimal('purchase_price', 10, 2);
        $table->decimal('sale_price', 10, 2);
        $table->integer('stock')->default(0);
        $table->integer('min_stock')->default(0);
        $table->text('description')->nullable();
        $table->boolean('active')->default(true);
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
        Schema::dropIfExists('products');
    }
};
