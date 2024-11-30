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
        Schema::create('patient_medicines', function (Blueprint $table) {
            $table->id("patient_medicine_id")->autoIncrement()->primary(true);
            $table->unsignedBigInteger("patient_id")->nullable(false);
            $table->foreign("patient_id")->references("patient_id")->on("patients")->onDelete("cascade");
            $table->unsignedBigInteger("medicine_id")->nullable(false);
            $table->foreign("medicine_id")->references("medicine_id")->on("medicines")->onDelete("cascade");
            $table->integer("qnt")->nullable(false);
            $table->integer("unt_price")->nullable(false);
            $table->integer("total_price")->nullable(false);
            $table->date("apply_date")->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_medicines');
    }
};
