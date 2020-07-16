<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    //
    protected $fillable = [
        'classroom_id', 'firstname', 'lastname', 'nickname', 'sex', 'birthday',
    ];
}
