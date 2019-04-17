<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admin_user_id')->unsigned();
            $table->bigInteger('student_user_id')->unsigned();
            $table->float('amount')->nullable(false)->default(0);
            $table->timestamps();

            $table->foreign('admin_user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('student_user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credits');
    }
}
