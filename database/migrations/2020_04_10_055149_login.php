<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Login extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('logins', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('category',20);
           $table->string('userid', 30)->unique();
           $table->string('pw', 60);
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
        Schema::dropIfExists('logins');
    }
}
