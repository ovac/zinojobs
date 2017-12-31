<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
