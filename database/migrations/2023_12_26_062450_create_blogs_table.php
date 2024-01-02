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
            $table->string('title');
            $table->longText('short_description');
            $table->longText('description');
            $table->longText('blog_media');
            $table->date('date');
            $table->string('time');
            $table->string('tags');
            $table->integer('is_active')->default('1')->nullable();
            $table->integer('is_deleted')->default('0')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
    }
};
