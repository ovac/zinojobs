<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $fillable = [
        'title',
        'description',
        'salary',
        'location',
        'closing',
        'qualification',
    ];

    protected $appends = ['applied'];

    protected $dates = ['closing'];

    public function getAppliedAttribute($model)
    {
        if (auth()->check()) {
            return (bool) $this->applications()->where('user_id', auth()->user()->id)->count();
        }

        return false;
    }

    public function poster()
    {
        return $this->belongsTo(User::class);
    }

    public function awardedTo()
    {
        return $this->belongsTo(User::class, 'id', 'awarded_to');
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
