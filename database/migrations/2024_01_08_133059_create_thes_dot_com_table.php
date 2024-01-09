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
        Schema::dropIfExists('thes_dot_com_raw');
        Schema::dropIfExists('thes_dot_com');

        Schema::create('thes_dot_com_raw', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->unsignedBigInteger('word_id')->nullable();
            $table->longText('raw')->nullable();
            $table->dateTime('crawled_at')->nullable();
            $table->unsignedTinyInteger('is_404')->nullable();
            $table->timestamps();

            $table->foreign('word_id')->references('id')->on('words')->onDelete('SET NULL');
        });

        Schema::create('thes_dot_com', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->unsignedBigInteger('word_id')->nullable();
            $table->longText('examples')->nullable();
            $table->longText('strongest_match')->nullable();
            $table->longText('strong_matches')->nullable();
            $table->longText('weak_match')->nullable();
            $table->dateTime('crawled_at')->nullable();
            $table->unsignedTinyInteger('is_404')->nullable();
            $table->timestamps();

            $table->foreign('word_id')->references('id')->on('words')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thes_dot_com');
    }
};
