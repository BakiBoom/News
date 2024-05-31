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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('path')->nullable(false)->default('/');
            $table->string('alias')->nullable(false)->default('/attachment');
            $table->string('type')->nullable(false);
            $table->string('fileName')->nullable(false)->default('');
            $table->unsignedBigInteger('postid')->nullable(false);
            $table->foreign('postid')->references('id')->on('posts');
            $table->timestamp('created_at')->nullable(false);
            $table->timestamp('updated_at')->nullable(false);
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
