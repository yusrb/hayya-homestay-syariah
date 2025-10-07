<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('facility_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_images');
        Schema::dropIfExists('facilities');
    }
};