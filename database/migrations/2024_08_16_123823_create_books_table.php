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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
        });


        Schema::create('book_chapters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->string('title');
            $table->longText('content');
            $table->string('poster');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('CASCADE');
        });


        Schema::create('book_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('chapter_id');
            $table->string('title');
            $table->longText('content');
            $table->string('poster');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('CASCADE');
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
