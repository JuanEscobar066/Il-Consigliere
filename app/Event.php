<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //protected $fillable = ['title','start_date','end_date'];
    protected $fillable = ['tipo_sesion','fecha','hora'];
}