<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
