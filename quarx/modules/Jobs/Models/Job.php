<?php

namespace Quarx\Modules\Jobs\Models;

use App\Job as Model;

class Job extends Model
{
    public $table = "jobs";

    public $primaryKey = "id";

    public $timestamps = true;

}
