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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->DateTime('date_debuit');
            $table->DateTime('date_fin');
            $table->string('lieu');
            $table->string('telephone');
            $table->string('image');
            $table->string('video')->nullable();
            $table->integer('montant');
            $table->integer('nombre_jour')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->enum('status', ['En attente', 'valider', 'terminer']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('type_demande_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('type_demande_id')
            ->references('id')
            ->on('type_demandes')
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
        Schema::dropIfExists('demandes');
    }
};
