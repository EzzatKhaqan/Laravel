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
        Schema::create('patient_tests', function (Blueprint $table) {
            $table->id("patient_test_id")->autoIncrement()->primary();
            $table->unsignedBigInteger("test_id")->nullable(false);
            $table->foreign("test_id")->references("test_id")->on("tests")->onDelete("cascade");
            $table->unsignedBigInteger("patient_id")->nullable(false);
            $table->foreign("patient_id")->references("patient_id")->on("patients")->onDelete("cascade");
            $table->unsignedBigInteger("staff_id")->nullable(false);
            $table->foreign("staff_id")->references("staff_id")->on("staff")->onDelete("cascade");
            $table->date("test_date")->nullable(false);
            $table->string("test_result",255)->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_tests');
    }
};
