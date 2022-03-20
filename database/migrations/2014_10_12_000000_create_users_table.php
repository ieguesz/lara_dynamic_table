<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            $table->increments('id_user');
            $table->string('usr_name');
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->rememberToken();
            $table->boolean('usr_estado')->default(1);
            // $table->timestamps();
        });

        /*[**** INSERT TABLE USERS****]*/
        DB::table('users')->insert([
            'usr_name'=>'IRWIN',
            'email'=>'ADMIN@ADMIN.COM',
            'password' => bcrypt('admin123')
            ]);
        DB::table('users')->insert([
            'usr_name'=>'ROBERT',
            'email'=>'ROBERT@ROBERT.COM',
            'password' => bcrypt('admin123')
            ]);
        DB::table('users')->insert([
            'usr_name'=>'JORGE',
            'email'=>'JORGE@JORGE.COM',
            'password' => bcrypt('admin123')
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
