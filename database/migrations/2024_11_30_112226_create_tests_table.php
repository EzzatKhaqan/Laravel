<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id("test_id")->autoIncrement()->primary(true);
            $table->string("test_name",64)->nullable(false);
            $table->string("desc",255)->nullable();
            $table->integer("test_price")->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
