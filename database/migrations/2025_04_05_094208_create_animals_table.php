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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->text('description');
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->foreignId('species_id')->constrained('species');
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('agecategory_id')->constrained('agecategories');
            $table->foreignId('genre_id')->constrained('genres');
            $table->foreignId('housing_stage_id')->constrained('housing_stages');
            $table->foreignId('size_id')->constrained('sizes');
            $table->foreignId('energylevel_id')->constrained('energy_levels');
            $table->boolean('identifier');
            $table->boolean('vaccines');
            $table->boolean('sterilization');
            $table->string('care')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
