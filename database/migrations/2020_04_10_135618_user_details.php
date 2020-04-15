<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_details', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('name',120);
           $table->string('gender',60);
           $table->date('dob');
           $table->string('phone',10);
           $table->string('emailID',120)->unique();
           $table->text('Address');
           $table->string('ID_Proff',200);
           $table->string('ID_Proff_Attachment',500);
           $table->string('User_image',500);
           $table->timestamp('created_at')->useCurrent = true;
           $table->timestamp('updated_at')->useCurrent = true;
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
