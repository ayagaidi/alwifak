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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('slug')->unique();
            $table->text('content_ar');
            $table->text('content_en');
            $table->text('excerpt_ar')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->datetime('published_at')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
