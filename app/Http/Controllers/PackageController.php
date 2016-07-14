<?php

namespace Padarom\UpdateServer\Http\Controllers;

use Padarom\UpdateServer\Models\Package;

class PackageController extends Controller
{
    public function getPackage($identifier)
    {
        return 'Package';
    }

    public function getPackageWithVersion($identifier, $versionNumber)
    {
        $package = Package::withIdentifier($identifier);
        if (!$package) {
            abort(404);
        }

        $version = null;
        foreach ($package->versions as $v) {
            if ($v->isVersion($versionNumber)) {
                $version = $v;
                break;
            }
        }

        if (!$version) {
            abort(404);
        }

        if (!file_exists($version->storagePath)) {
            abort(404);
        }

        return response()->download($version->storagePath, $identifier . '.tar');
    }
}
