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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->text('description')->nullable(false);
            $table->date('publishdate')->nullable();
            $table->timestamp('created_at')->nullable(false);
            $table->timestamp('updated_at')->nullable(false);
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('isdeleted')->default(false);
            $table->boolean('ispublish')->default(false);
            $table->unsignedBigInteger('categoryid')->nullable(false);
            $table->foreign('categoryid')->references('id')->on('categories');
            $table->unsignedBigInteger('tagid')->nullable(false);
            $table->foreign('tagid')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
