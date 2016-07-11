<?php

$app->get('/', ['middleware' => 'package', function () use ($app) {
    return $app->version();
}]);

// Download a single package
$app->get('package/{identifier}', ['as' => 'get-package', 'uses' => 'PackageController@getPackage']);
$app->get('package/{identifier}/{version}', ['as' => 'get-package-with-version', 'uses' => 'PackageController@getPackageWithVersion']);