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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->text('reason');
            $table->foreignId('housing_stage_id')->constrained('housing_stages');
            $table->foreignId('animal_id')->constrained('animals');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('shelter_id')->nullable()->constrained('shelters');
            $table->foreignId('breeder_id')->nullable()->constrained('breeders');
            $table->timestamp('created_at')->useCurrent();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
