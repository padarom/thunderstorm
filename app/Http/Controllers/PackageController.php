<?php

namespace Padarom\Thunderstorm\Http\Controllers;

use Padarom\Thunderstorm\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function getPackage($identifier)
    {
        return 'Package';
    }

    public function getPackageFromParameters(Request $request)
    {
        $identifier = $request->get('packageName', null);
        $version    = $request->get('packageVersion', null);

        if ($version && $identifier) {
            return $this->getPackageWithVersion($identifier, $version);
        } elseif ($version) {
            return $this->getPackage($identifier);
        }

        return abort(405);
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
