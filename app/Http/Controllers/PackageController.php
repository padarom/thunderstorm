<?php

namespace Padarom\UpdateServer\Http\Controllers;

class PackageController extends Controller
{
    public function getPackage($identifier)
    {
        return 'Package';
    }

    public function getPackageWithVersion($identifier, $version)
    {
        return 'Package with version';
    }
}
