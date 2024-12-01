<?php

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\staff;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("patient_id")->nullable(false);
            $table->foreign("patient_id")->references("patient_id")->on("patients")->onDelete("cascade");
            $table->unsignedBigInteger("staff_id")->nullable(false);
            $table->foreign("staff_id")->references("staff_id")->on("staff")->onDelete("cascade");
            $table->date("appointment_date")->nullable(false);
            $table->time("appointment_time")->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
