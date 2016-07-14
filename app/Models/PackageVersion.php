<?php

namespace Padarom\UpdateServer\Models;

use Illuminate\Database\Eloquent\Model;

class PackageVersion extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name', 'updatetype', 'versiontype', 'license', 'timestamp',
    ];

    public function isVersion($number)
    {
        $comparison = $this->name;

        return $comparison == $number || $comparison == str_replace('_', ' ', $number);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function updatableVersions()
    {
        return $this->hasMany(UpdatableVersion::class, 'version_id');
    }

    public function requiredPackages()
    {
        return $this->hasMany(MentionedPackage::class, 'version_id')->where('type', 'required');
    }

    public function excludedPackages()
    {
        return $this->hasMany(MentionedPackage::class, 'version_id')->where('type', 'excluded');
    }

    public function getDownloadURLAttribute()
    {
        $identifier = $this->package->identifier;
        $version = str_replace(' ', '_', $this->name);
        
        return route('get-package-with-version', compact('identifier', 'version'));
    }

    public function getStoragePathAttribute()
    {
        $path  = storage_path('packages/' . $this->package->identifier . '/');
        $path .= str_replace(' ', '_', $this->name) . '.tar';

        return $path;
    }
}