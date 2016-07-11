<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', ['middleware' => 'package', function () use ($app) {
    return $app->version();
}]);

$app->get('package/{identifier}', ['as' => 'get-package', function($identifier) {
    return $identifier;
}]);

$app->get('package/{identifier}/{version}', ['as' => 'get-package-with-version', function($identifier, $version) {
    return $identifier . ' ' . $version;
}]);