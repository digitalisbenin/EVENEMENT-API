<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signalers', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('demande_id')->nullable();
            $table->timestamps();

            $table->foreign('demande_id')
            ->references('id')
            ->on('demandes')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signalers');
    }
};
