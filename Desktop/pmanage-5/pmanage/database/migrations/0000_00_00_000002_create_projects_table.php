<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained('work_spaces');
            $table->string('name');
            $table->text('description')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
