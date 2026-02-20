<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('slot_id')
                ->constrained()
                ->cascadeOnDelete();

            // Public reference to show on success page / emails
            $table->string('reference', 32)->unique();

            $table->string('name', 120);
            $table->string('email', 190);
            $table->string('phone', 40)->nullable();

            $table->unsignedSmallInteger('people_count');

            // Snapshot prices at time of booking
            $table->unsignedInteger('unit_price_cents');
            $table->unsignedInteger('total_amount_cents');
            $table->string('currency', 3)->default('EUR');

            $table->string('status')->default('pending');
            // pending|paid|confirmed|canceled|expired|failed|refunded

            $table->dateTime('paid_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('canceled_at')->nullable();

            $table->timestamps();

            $table->index(['slot_id', 'status']);
            $table->index(['status', 'created_at']);
            $table->index(['email', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
