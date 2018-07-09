<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'unique' => false,
            ],
        ];
    }

    public $timestamps = false;

    protected $casts = [
        'city_id' => 'integer',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
