<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('words_manual_map')->nullable();
            $table->string('name')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('song_word', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('word_id')->nullable();
            $table->unsignedBigInteger('song_id')->nullable();
            $table->string('offset_time')->nullable();

            $table->foreign('word_id')->references('id')->on('words')->onDelete('CASCADE');
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_word');
        Schema::dropIfExists('words');
    }
};
