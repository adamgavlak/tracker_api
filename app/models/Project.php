<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'color'];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}