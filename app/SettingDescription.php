<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingDescription extends Model
{
//
    protected $table = 'setting_description';
    protected $fillable = ['setting_id', 'setting_description_english', 'setting_description_thai'];
}
