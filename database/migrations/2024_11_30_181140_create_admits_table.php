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
        Schema::create('admits', function (Blueprint $table) {
            $table->id("admit_id")->primary()->autoIncrement();
            $table->unsignedBigInteger("patient_id")->nullable(false);
            $table->foreign("patient_id")->references("patient_id")->on("patients");
            $table->unsignedBigInteger("room_number")->nullable(false);
            $table->foreign("room_number")->references("room_number")->on("rooms");
            $table->dateTime("in_date")->nullable(false);
            $table->dateTime("out_date")->nullable();
            $table->enum("status",["leave","bed"])->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admits');
    }
};
