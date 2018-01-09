<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    ///////////////////////////////////////////////
    /* Picture Relationships */
    ///////////////////////////////////////////////

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
