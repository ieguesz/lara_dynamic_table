<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->string('mnu_descripcion',20);
            // $table->string('',100)->nullable();
            $table->boolean('mnu_estado')->default(1);
        });

         /*[**** INSERT TABLE USERS****]*/
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'PRODUCCIÓN',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'LOGISTICA',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'RRHH',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'PERMISOS',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'VENTAS',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'COMPRAS',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'TESORERIA',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'PRESUPUESTOS',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'FINANZAS',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'CONTABILIDAD',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'TEGNOLOGIAS',
                ]);
            DB::table('menus')->insert([
                'mnu_descripcion'=> 'INNOVACION',
                ]);
            DB::table('menus')->insert([
            'mnu_descripcion'=> 'SERVICIO AL CLIENTE',
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
