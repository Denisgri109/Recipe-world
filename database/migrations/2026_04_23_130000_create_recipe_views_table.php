<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipe_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('viewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('ip_hash', 64)->nullable();
            $table->string('user_agent', 1024)->nullable();
            $table->timestamp('viewed_at');
            $table->date('viewed_on');

            $table->index(['recipe_id', 'viewed_on']);
            $table->unique(['recipe_id', 'viewer_id', 'viewed_on']);
            $table->unique(['recipe_id', 'ip_hash', 'viewed_on']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe_views');
    }
};
