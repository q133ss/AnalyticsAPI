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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('text')->nullable();
            $table->string('file_src')->nullable();
            $table->string('preview_src')->nullable();
            $table->string('format');
            $table->string('video_link')->nullable();
            $table->foreignId('category_id');
            $table->enum('type', ['client', 'all', 'special']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
