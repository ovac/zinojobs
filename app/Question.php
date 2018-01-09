<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    ///////////////////////////////////////////////
    /* Job Relationships */
    ///////////////////////////////////////////////

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
