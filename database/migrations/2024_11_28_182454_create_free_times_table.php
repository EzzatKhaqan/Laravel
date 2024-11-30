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
        Schema::create('free_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("staff_id")->nullable(false);
            $table->foreign("staff_id")->references("staff_id")->on("staff");
            $table->date("free_time_date")->nullable(false);
            $table->integer("hours")->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_times');
    }
};
