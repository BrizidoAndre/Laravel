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
        Schema::create('genre', function(Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
        });

        Schema::create('movie', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genreId');
            $table->foreign('genreId')->references('id')->on('genre');
            $table->string('title')->unique();
            $table->text('synopsis');
            $table->integer('durationMinutes');
            $table->char('releaseDate', 10);
            $table->text('posterUrl')->nullable();
            $table->text('trailerUrl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('genre');
        Schema::drop('movie');
    }
};
