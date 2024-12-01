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
        Schema::create('patient_treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable(false);
            $table->foreign("patient_id")->references("patient_id")->on("patients")->onDelete("cascade");
            $table->unsignedBigInteger("staff_id")->nullable(false);
            $table->foreign("staff_id")->references("staff_id")->on("staff")->onDelete("cascade");
            $table->unsignedBigInteger('treatment_id')->nullable(false);
            $table->foreign("treatment_id")->references("id")->on("treatments")->onDelete("cascade");
            $table->date("treatment_date")->nullable(false);
            $table->string("treatment_result",255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_treatments');
    }
};
