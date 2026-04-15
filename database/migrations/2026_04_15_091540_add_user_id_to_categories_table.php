<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'user_id')) $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        });
        Schema::table('recipes', function (Blueprint $table) {
            if (!Schema::hasColumn('recipes', 'price')) $table->decimal('price', 8, 2)->default(0);
        });
    }
    public function down(): void {}
};
