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
//        Schema::dropIfExists('dic_dot_com_raw');
        Schema::dropIfExists('dic_dot_com');
        Schema::dropIfExists('dic_dot_com_raw');

        Schema::create('dic_dot_com_raw', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->unsignedBigInteger('word_id')->nullable();
            $table->tinyInteger('crawler_type')->nullable();
            $table->longText('raw')->nullable();
            $table->dateTime('crawled_at')->nullable();
            $table->unsignedTinyInteger('is_404')->nullable();
            $table->timestamps();

            $table->foreign('word_id')->references('id')->on('words')->onDelete('SET NULL');
        });

        Schema::create('dic_dot_com', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->string('origin');
            $table->string('word_type');
            $table->string('defs');

            $table->unsignedBigInteger('word_id')->nullable();
            $table->unsignedBigInteger('dic_dot_com_raw_id')->nullable();
            $table->tinyInteger('crawler_type')->nullable();
            $table->longText('raw')->nullable();
            $table->dateTime('crawled_at')->nullable();
            $table->unsignedTinyInteger('is_404')->nullable();
            $table->timestamps();

            $table->foreign('word_id')->references('id')->on('words')->onDelete('SET NULL');
            $table->foreign('dic_dot_com_raw_id')->references('id')->on('dic_dot_com_raw')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dic_dot_com');
        Schema::dropIfExists('dic_dot_com_raw');
    }
};
