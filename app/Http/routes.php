<?php

$app->get('/', 'ListController@getFullList');
$app->post('/', 'PackageController@getPackageFromParameters');

// Download a single package
$app->get('package/{identifier}', ['as' => 'get-package', 'uses' => 'PackageController@getPackage']);
$app->get('package/{identifier}/{version}', ['as' => 'get-package-with-version', 'uses' => 'PackageController@getPackageWithVersion']);