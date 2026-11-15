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
        Schema::create('materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('grade')->nullable(); //-- марка или характеристика
            $table->string('standard')->nullable(); //-- стандарт ГОСТ, ТУ итд
            $table->string('unit'); //-- Единица измерения
            $table->string('manufacturer')->nullable(); //-- Производитель
            $table->string('description')->nullable(); //-- Описание материала
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
