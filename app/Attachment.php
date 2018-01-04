<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
