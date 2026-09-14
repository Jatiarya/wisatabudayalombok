<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trip_id')->constrained()->cascadeOnDelete();
            $table->date('departure_date');
            $table->unsignedInteger('participants');
            $table->decimal('total_price', 12, 2);
            $table->string('phone');
            $table->text('notes')->nullable();
            // Tambahkan 'completed' ke dalam array ENUM
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->enum('payment_status', ['unpaid', 'paid', 'expired', 'failed'])->default('unpaid');
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};