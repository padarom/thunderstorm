<?php

namespace Padarom\Thunderstorm\Http\Controllers;

use Illuminate\Http\Request;
use Padarom\Thunderstorm\Models\Package;

class ListController extends Controller
{
    public function getFullList(Request $request)
    {
        // $context = $this->isWCF($request) ? 'xml' : 'html';
        $context = 'xml'; // Force XML for now

        $packages = Package::all();

        $content = view($context . '.list')->with(compact('packages'));
        return $this->response($context, $content);
    }
}
