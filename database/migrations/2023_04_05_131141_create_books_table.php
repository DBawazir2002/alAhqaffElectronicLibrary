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
            $table->foreignId('category_id')->onDelete('cascade');
            $table->string('title');
            $table->string('authorName');
            $table->tinyInteger('rate')->default(0);
            $table->string('size')->default(0);
            $table->text('brief');
            $table->integer('numberOfDownloads')->default(0);
            $table->integer('cost');
            $table->text('bookCover')->default('booksCover/default.jpg');
            $table->text('book');
            $table->timestamps();
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
