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
        Schema::create('staff',function(Blueprint $table){
            $table->id("staff_id");
            $table->string('firstname',64)->nullable(false);
            $table->string('lastname',64)->nullable(false);
            $table->enum('staff_type',["Doctor","Nurse","Guard","Other"])->nullable(false)->default('Other');
            $table->string('position',64)->nullable();
            $table->enum('gender',["male","female"])->nullable(false);
            $table->string('photo',128)->nullable();
            $table->string('address',128)->nullable();
            $table->string('phone',16)->unique()->nullable();
            $table->date('DOB')->nullable();
            $table->string('net_salary',128)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
