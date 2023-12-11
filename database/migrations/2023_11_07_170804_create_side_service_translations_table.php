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
        Schema::create('side_service_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('title');
            $table->foreignId('side_service_id')->references('id')->on('side_services')->onDelete('cascade');
            $table->unique(['side_service_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('side_service_translations');
    }
};
