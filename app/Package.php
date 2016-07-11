<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $disableTimestamps = true;
    
    public static function withIdentifier($identifier)
    {
        return self::where('identifier', $identifier);
    }
}