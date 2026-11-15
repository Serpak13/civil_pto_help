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
        Schema::create('quality_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            //-- TODO модель материала и связать с сертификатом, возможно даже many-to-many, разобраться
            $table->integer('type');
            $table->string('number');
            $table->date('date_from');
            $table->date('date_to');
            //-- $table->string('file_id'); TODO сделать модельку файла с миграцией и связь и настроить хранение файлов
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_documents');
    }
};
