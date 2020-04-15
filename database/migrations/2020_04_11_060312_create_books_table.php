<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bookID',30);
            $table->text('bname');
            $table->string('author',500);
            $table->bigInteger('price');
            $table->text('description');
            $table->string('publisher',500);
            $table->string('bCategory',200);
            $table->bigInteger('bcount');
            $table->string('bImage',200);
            $table->string('status',200);
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
        Schema::dropIfExists('books');
    }
}
