<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profession_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profession_id')->constrained()->onDelete('cascade');
            $table->string('skill_name');
            $table->integer('count')->default(0);
            $table->timestamp('last_updated')->nullable();
            $table->timestamps();

            $table->unique(['profession_id', 'skill_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profession_skills');
    }
};
