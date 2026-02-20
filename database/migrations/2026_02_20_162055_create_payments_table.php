<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('provider')->default('mollie');
            $table->string('provider_payment_id')->nullable()->index();

            $table->string('provider_status')->nullable();
            // open|paid|failed|canceled|expired|refunded|authorized etc.

            $table->unsignedInteger('amount_cents');
            $table->string('currency', 3)->default('EUR');

            $table->json('webhook_payload')->nullable();

            $table->dateTime('paid_at')->nullable();

            $table->timestamps();

            $table->unique(['provider', 'provider_payment_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
