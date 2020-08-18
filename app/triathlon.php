<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class triathlon extends Model
{
    //
    protected $fillable = ['triathlon_name', 'event_date_on', 'city_name', 'state_name', 'zip_code'];
}
