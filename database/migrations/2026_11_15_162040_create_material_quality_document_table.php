<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('material_quality_document', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->foreignUuid('material_id')->constrained('materials')->cascadeOnDelete();
            $table->foreignUuid('quality_document_id')->constrained('quality_documents')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['material_id', 'quality_document_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_quality_document');
    }
};
