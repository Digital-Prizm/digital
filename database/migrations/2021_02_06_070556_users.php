<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users', function (Blueprint $table) {
            //$table->id();
			$table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
			$table->string('password');
			$table->integer('role_id');
			$table->string('status');
            $table->dateTime('createdDate');
			$table->string('createdBy');
			$table->dateTime('updatedDate');
			$table->string('updatedBy');
			
        });
		
		 DB::table('users')->insert(
            array(
                'email' => 'admin@gmail.com',
                'password' => 'admin',
				'name' => 'Tamil'
            )
        );

		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('users');
    }
}
