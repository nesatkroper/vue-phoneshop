<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('brand')->nullable();
            $table->integer('cate')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('desc')->nullable();
            $table->string('promo')->nullable();
            $table->enum('status', ['0', '1']);
            $table->enum('delete', ['0', '1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
