<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = "calendars";
    protected $fillable = ['teacher_id','lesson_date','time_from','time_to','document','lesson_id','student_id','status','lesson_price'];

    public function lesson(){
    	return $this->belongsTo('App\Lesson');
    }
}
