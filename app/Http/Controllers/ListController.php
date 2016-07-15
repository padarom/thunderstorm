<?php

namespace Padarom\Thunderstorm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Padarom\Thunderstorm\Models\Package;

class ListController extends Controller
{
    public function getFullList(Request $request)
    {
        // $context = $this->isWCF($request) ? 'xml' : 'html';
        $context = 'xml'; // Force XML for now

        $packages = Package::all();

        $content = $this->getCachedContent('xml.renderedPath', function () use ($context, $packages) {
            return view($context . '.list')->with('packages', $packages);
        });

        return $this->response($context, $content);
    }

    protected function getCachedContent($name, callable $created)
    {
        if (Cache::has('xml.renderedPath')) {
            $filename = storage_path('framework/views/' . Cache::get('xml.renderedPath'));
            if (file_exists($filename)) {
                return file_get_contents($filename);
            }
        }

        $content = call_user_func($created);
        $filename = str_random(32) . '.cached';
        file_put_contents(storage_path('framework/views/' . $filename), $content);

        // Save the filename
        Cache::forever($name, $filename);

        return $content;
    }
}
