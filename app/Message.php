<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['agent_id','user_id','property_id','nama','email','phone','message','status'];
}
