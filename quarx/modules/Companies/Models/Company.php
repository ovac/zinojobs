<?php

namespace Quarx\Modules\Companies\Models;

use App\Company as QuarxModel;

class Company extends QuarxModel
{
    public $table = "companies";

    public $primaryKey = "id";

    public $timestamps = true;
}
