<?php

namespace Padarom\UpdateServer\Models;

use Illuminate\Database\Eloquent\Model;

class PackageVersion extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name', 'updatetype', 'versiontype', 'license', 'timestamp',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getCompatibilityTreeAttribute()
    {
        return [
            new PackageVersion(['name' => '1.0.0 RC']),
        ];
    }

    public function getRequirementsAttribute()
    {
        return [
            new VersionRequirement(['package' => 'com.clanunknownsoldiers.plugin.base', 'min' => '1.0.0 Beta 1']),
        ];
    }
}