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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id("medicine_id")->primary()->autoIncrement()->unique();
            $table->string("medicine_name")->nullable(false);
            $table->string("desc",255)->nullable();
            $table->date("exp_date")->nullable(false);
            $table->integer("unt_price")->nullable(false);
            $table->integer("qnt")->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
