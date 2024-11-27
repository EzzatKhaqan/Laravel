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
        Schema::create('patients', function (Blueprint $table) {
            $table->id("patient_id")->autoIncrement()->unique()->primary();
            $table->string("firstname",64)->nullable(false);
            $table->string("lastname",64)->nullable(false);
            $table->enum("gender",['male','female'])->nullable(false);
            $table->string("address")->nullable();
            $table->string("phone")->nullable(false)->unique();
            $table->string("DOB")->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
