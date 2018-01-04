<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
