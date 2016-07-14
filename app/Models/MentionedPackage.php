<?php

namespace Padarom\UpdateServer\Models;

use Illuminate\Database\Eloquent\Model;

class MentionedPackage extends Model
{
    public $timestamps = false;

    public $fillable = [
        'identifier', 'version', 'type'
    ];

    public function version()
    {
        return $this->belongsTo(PackageVersion::class, 'version_id');
    }
}