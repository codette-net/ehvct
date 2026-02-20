<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tour_variant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->dateTime('starts_at');

            $table->unsignedSmallInteger('min_people')->default(1);
            $table->unsignedSmallInteger('max_people')->default(10);

            $table->unsignedSmallInteger('booking_cutoff_hours')->default(2);
            $table->unsignedSmallInteger('cancel_cutoff_hours')->default(24);

            $table->string('status')->default('active'); // active|canceled

            $table->timestamps();

            $table->index(['tour_variant_id', 'starts_at']);
            $table->index(['starts_at', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
