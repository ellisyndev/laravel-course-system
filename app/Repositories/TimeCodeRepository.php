<?php

namespace App\Repositories;

use App\Models\TimeCode;

class TimeCodeRepository extends BaseRepository
{
    public function __construct(TimeCode $code)
    {
        parent::__construct($code);
    }
}
