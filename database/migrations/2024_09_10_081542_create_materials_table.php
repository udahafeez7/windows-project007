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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('category_id');
            $table->integer('pretasks_id');
            $table->string('code')->nullable();
            $table->string('image')->nullable();
            $table->string('admin_id')->nullable();
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->boolean('status_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};