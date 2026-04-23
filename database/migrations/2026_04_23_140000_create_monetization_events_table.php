<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monetization_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->string('event_type', 50);
            $table->decimal('amount', 19, 4);
            $table->char('currency', 3);
            $table->timestamp('occurred_at');
            $table->timestamps();

            $table->index(['creator_id', 'currency']);
            $table->index(['creator_id', 'occurred_at']);
            $table->index(['recipe_id', 'occurred_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monetization_events');
    }
};
