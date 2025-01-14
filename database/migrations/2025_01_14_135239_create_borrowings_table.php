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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\BookCopy::class)->constrained();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->dateTime('borrowed_at');
            $table->dateTime('due_at')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
