<?php

namespace Padarom\Thunderstorm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Padarom\Thunderstorm\Models\LocalizedTag;
use Padarom\Thunderstorm\Models\Package;

class ListController extends Controller
{
    public function getFullList(Request $request)
    {
        $context = $this->isWCF($request) || $request->has('forcexml') ? 'xml' : 'html';
        $packages = Package::all();

        $arguments = ['packages' => $packages];

        // Add additional data to the view if it's an HTML request
        if ($context == 'html') {
            $arguments = array_merge($arguments, $this->getHtmlArguments($request));
        }

        $content = $this->getCachedContent($context . '.renderedPath', function () use ($context, $arguments) {
            return view($context . '.list', $arguments);
        });

        return $this->response($context, $content);
    }

    protected function getHtmlArguments($request)
    {
        // Force XML query string for footer
        if ($querystring = $request->getQueryString()) {
            $querystring = '?' . $querystring . '&forcexml=1';
        } else {
            $querystring = '?forcexml=1';
        }

        return [
            'languages' => LocalizedTag::all()->pluck('language')->unique(),
            'pageTitle' => env('PAGE_TITLE'),
            'query' => $querystring,
        ];
    }

    protected function getCachedContent($name, callable $created)
    {
        // Prevent caching in debug mode
        if (env('APP_DEBUG')) {
            return call_user_func($created);
        }

        if (Cache::has($name)) {
            if (file_exists(Cache::get($name))) {
                return file_get_contents(Cache::get($name));
            }
        }

        $content = call_user_func($created);
        $filename = storage_path('framework/views/' . str_random(32) . '.cached');

        try {
            file_put_contents($filename, $content);

            // Save the filename
            Cache::forever($name, $filename);
        } catch (\Exception $e) {
            // Nothing for now
        }

        return $content;
    }
}
