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
        Schema::create('patient_records', function (Blueprint $table) {
            $table->id("patient_record_id")->unique()->primary()->autoIncrement();
            $table->unsignedBigInteger('patient_id')->nullable(false);
            $table->foreign("patient_id")->references("patient_id")->on("patients")->onDelete("cascade");
            $table->unsignedBigInteger("staff_id")->nullable(false);
            $table->foreign("staff_id")->references("staff_id")->on("staff")->onDelete("cascade");
            $table->string("sickness",128)->nullable();
            $table->string("result",500)->nullable();
            $table->time("time_in")->nullable(false);
            $table->time("time_out")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_records');
    }
};
