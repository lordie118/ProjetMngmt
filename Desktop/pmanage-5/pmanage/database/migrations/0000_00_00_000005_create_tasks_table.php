<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained('cards');
            $table->string('name');
            $table->boolean('done')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
