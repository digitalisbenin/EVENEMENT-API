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
        Schema::table('publications', function (Blueprint $table) {
            $table->dateTime('date_debuit')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->enum('status', ['En attente', 'valider', 'terminer', 'suspendre'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn('date_debuit');
            $table->dropColumn('date_fin');
            $table->dropColumn('status');
        });
    }
};
