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
        Schema::create('event', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('event_name')->unique();
            $table->text('description');
            $table->foreignUuid('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->string('location');
            $table->string('image_url')->nullable()->default(null);
            $table->dateTime('date');
            $table->integer('participants_number');
            $table->integer('max_participants_number');
            $table->dateTime('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
