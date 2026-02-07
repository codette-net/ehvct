<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $table->morphs('mediable'); // mediable_type, mediaable_id
            $table->string('role')->default('gallery'); // cover|gallery|site_gallery
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['mediable_type', 'mediable_id','role']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediables');
    }
};
