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
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
        });

        Schema::create('artist', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->char('birthday', 10);
            $table->text('photoUrl')->nullable();
            $table->text('biography')->nullable();
        });

        Schema::create('credit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movieId');
            $table->unsignedBigInteger('roleId');
            $table->unsignedBigInteger('artistId');
            $table->foreign('movieId')->references('id')->on('movie');
            $table->foreign('roleId')->references('id')->on('role');
            $table->foreign('artistId')->references('id')->on('artist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
