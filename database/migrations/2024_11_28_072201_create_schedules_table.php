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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id')->primary()->unique();
            $table->unsignedBigInteger("staff_id")->nullable(false);
            $table->foreign("staff_id")->references("staff_id")->on("staff");
            $table->string("weekday")->nullable(false);
            $table->time("start_time")->nullable(false);
            $table->date("start_date")->nullable(false);
            $table->time("end_time")->nullable(false);
            $table->date("end_date")->nullable(false);
            $table->boolean("expired")->nullable(false)->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
