<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        "email"
    ];
    protected $hidden = [
        "password", "api_key"
    ];

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function trackings()
    {
        return $this->hasMany('App\Models\Tracking');
    }
}