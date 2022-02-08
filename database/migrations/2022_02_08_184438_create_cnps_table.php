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
        Schema::create('cnps', function (Blueprint $table) {
            $table->id();
            $table->integer('gondola');
            $table->integer('body_gondola');
            $table->integer('faces');
            $table->integer('level');
            $table->integer('depth');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('center_operation_id')->constrained('center_operations');
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
        Schema::dropIfExists('cnps');
    }
};