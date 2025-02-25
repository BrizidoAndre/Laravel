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
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('movieId');
            $table->foreign('userId')->references('id')->on('user');
            $table->foreign('movieId')->references('id')->on('movie');
            $table->text('content')->nullable();
            $table->integer('stars')->nullable();
            $table->timestamp('createdAt');
        });

        Schema::create('reviewevaluation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('reviewId');
            $table->foreign('userId')->references('id')->on('user');
            $table->foreign('reviewId')->references('id')->on('review');
            $table->boolean('positive');
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
