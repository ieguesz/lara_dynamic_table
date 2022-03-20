<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelacionToPermisoDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permiso_detalles', function (Blueprint $table) {
            //
            $table->foreign('id_menu')
            ->references('id_menu')
            ->on('menus');
            $table->foreign('id_permiso')
            ->references('id_permiso')
            ->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permiso_detalles', function (Blueprint $table) {
            //
             $table->dropForeign(['id_menu']);
             $table->dropForeign(['id_permiso']);
        });
    }
}
