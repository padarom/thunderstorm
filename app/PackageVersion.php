<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageVersion extends Model
{
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}