<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['location', 'note'];

    protected $casts = ['time' => 'datetime'];

    ///////////////////////////////////////////////
    /* Invitation for Intervew Relationships */
    ///////////////////////////////////////////////

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
