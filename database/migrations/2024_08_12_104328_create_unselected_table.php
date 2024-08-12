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
        Schema::create('unselected', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Correct column type for foreign key
            $table->unsignedBigInteger('service_id'); // Correct column type for foreign key
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('service_id')->references('id')->on('service_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unselected');
    }
};
