<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('action', 100);
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->string('executed_by')->default('system');
            $table->timestamp('executed_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_logs');
    }
};
