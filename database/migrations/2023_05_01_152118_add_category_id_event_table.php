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
        Schema::table('events', function (Blueprint $table) {

            //1 qui aggiungiamo la colonna
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

             //2 qui aggiungiamo la relazione tra chiave esterna e chiave primaria
             $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {

            //2 droppiamo la relazione
            $table->dropForeign(['category_id']);

             //1 droppianmo la colonna
             $table->dropColumn('category_id');
        });
    }
};
