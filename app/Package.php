<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $fillable = [
        'identifier', 'author', 'authorurl',
    ];

    public $timestamps = false;
    
    public static function withIdentifier($identifier)
    {
        return self::where('identifier', $identifier)->first();
    }

    public function versions()
    {
        return $this->hasMany(PackageVersion::class);
    }
}