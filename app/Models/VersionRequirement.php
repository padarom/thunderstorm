<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VersionRequirement extends Model
{
    public $timestamps = false;

    public $fillable = [
        'package', 'min',
    ];

    public function version()
    {
        return $this->belongsTo(PackageVersion::class);
    }
}