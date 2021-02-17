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
        /*
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();
        });
        */
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('salutation_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender_id');
            $table->string('phone');
            $table->string('mobile');
            $table->text('primary_address');
            $table->text('secondary_address');
            $table->date('dob');
            $table->date('assumed_date');
            $table->string('occupation_id');
            $table->string('company');
            $table->string('company_address')->nullable();
            $table->string('industry_id');
            $table->string('sub_industry_id');
            $table->string('skill');
            $table->integer('rate');
            $table->string('family_firstname')->nullable();
            $table->string('family_lastname')->nullable();
            $table->string('family_email')->nullable();
            $table->string('family_phone')->nullable();
            $table->string('family_gender_id')->nullable();
            $table->string('family_relation_id');
            $table->string('family_color_indicator')->nullable();
            $table->text('file_single');
            $table->json('file_multiple');
            $table->datetime('expiry_date');
            $table->datetime('expiry_before_date')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('status');
            $table->datetime('created_at');
            $table->string('created_by');
            $table->datetime('updated_at');
            $table->string('updated_by');
            //$table->foreignId('current_team_id')->nullable();
        });

       
        
       // Team::create([ 'user_id' => 1, 'name' => 'admin-team', 'personal_team' => '1', ]);
       // insert into teams (user_id,name,personal_team) values(1,'admin-team',1);

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
