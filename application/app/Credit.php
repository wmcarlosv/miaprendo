<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = "credits";
    protected $fillable = ['admin_user_id','student_user_id','amount'];

    public function user(){
    	return $this->belongsTo('App\User','student_user_id','id');
    }
}
