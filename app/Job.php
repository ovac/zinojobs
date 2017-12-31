<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $appends = ['applied'];

    public function getAppliedAttribute($model)
    {
        if (auth()->check()) {
            return (bool) $this->applications()->where('user_id', auth()->user()->id)->count();
        }

        return false;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
