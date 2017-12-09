<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = ['user_id', 'project_id', 'day', 'from', 'to'];

    protected $hidden = ['user_id', 'project'];

    protected $appends = ['project_name', 'project_color'];

    public function getProjectNameAttribute()
    {
        return $this->project->name;
    }

    public function getProjectColorAttribute()
    {
        return $this->project->color;
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}