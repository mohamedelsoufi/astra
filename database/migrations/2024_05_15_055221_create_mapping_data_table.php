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
        Schema::create('mapping_data', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->unsignedInteger('main_data_id')->nullable();
            $table->enum('condition_reason', ['A', 'B', 'C'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping_data');
    }
};
