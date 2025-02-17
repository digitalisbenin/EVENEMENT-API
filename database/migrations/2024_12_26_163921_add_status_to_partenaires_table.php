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
        Schema::table('partenaires', function (Blueprint $table) {
            $table->enum('status', ['afficher', 'masquer'])->nullable();
            $table->string('sigle')->nullable();
            $table->string('contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partenaires', function (Blueprint $table) {
            //$table->dropColumn(['status', 'status', 'contact']);
            $table->dropColumn('status');
            $table->dropColumn('status');
            $table->dropColumn('contact');
        });
    }
};
