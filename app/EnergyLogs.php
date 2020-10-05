<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnergyLogs extends Model
{
    //
    protected $guarded = [];

    public function school(){
        return $this->belongTo(School::class);
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
