<?php

namespace App;

use App\Models\User;
use Yab\Quarx\Models\QuarxModel as Model;

class Company extends Model
{

    protected $fillable = [
        'name',
        'industry',
        'address',
        'employees',
        'details',
        'mission',
        'founded',
    ];

    protected $dates = ['founded'];

    ///////////////////////////////////////////////
    /* Company Relationships */
    ///////////////////////////////////////////////

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
