<?php

namespace Padarom\Thunderstorm\Models;

use Illuminate\Database\Eloquent\Model;

class UpdatableVersion extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name'
    ];

    public function version()
    {
        return $this->belongsTo(PackageVersion::class, 'version_id');
    }
}