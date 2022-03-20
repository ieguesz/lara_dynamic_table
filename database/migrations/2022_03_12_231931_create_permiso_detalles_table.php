<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso_detalles', function (Blueprint $table) {
            $table->increments('id_permiso_detalle');
            $table->integer('id_menu')->unsigned();
            $table->integer('id_permiso')->unsigned();
            $table->boolean('pd_estado')->default(1);

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso_detalles');
    }
}
