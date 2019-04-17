<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('teacher_id')->unsigned();
            $table->date('lesson_date')->nullable(false);
            $table->time('time_from')->nullable(false);
            $table->time('time_to')->nullable(false);
            $table->string('document',100)->nullable(false);
            $table->bigInteger('lesson_id')->nullable();
            $table->bigInteger('student_id')->nullable();
            $table->boolean('status')->nullable(false)->default(false);            
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}