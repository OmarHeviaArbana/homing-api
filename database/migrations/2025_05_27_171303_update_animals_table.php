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
        Schema::table('animals', function (Blueprint $table) {
            $table->foreignId('shelter_id')->nullable()->constrained('shelters');
            $table->foreignId('breeder_id')->nullable()->constrained('breeders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropForeign(['shelter_id']);
            $table->dropForeign(['breeder_id']);
            $table->dropColumn(['shelter_id', 'breeder_id']);
        });
    }
};
