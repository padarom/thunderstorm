<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $fillable = [
        'identifier', 'author', 'authorurl',
    ];

    public $disableTimestamps = true;
    
    public static function withIdentifier($identifier)
    {
        return self::where('identifier', $identifier);
    }

    public function versions()
    {
        return $this->hasMany(PackageVersion::class);
    }
}