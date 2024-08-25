<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->text('small_logo');
            $table->text('logo');
            NestedSet::columns($table);
            $table->timestamps();

        });


        Schema::create('item_genres', function (Blueprint $table) {
            $table->id();
            $table->string('genre_id');
            $table->string('item_id');
            $table->string('item_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
        Schema::dropIfExists('item_genres');
    }
};
