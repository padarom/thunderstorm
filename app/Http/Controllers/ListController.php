<?php

namespace Padarom\UpdateServer\Http\Controllers;

use Illuminate\Http\Request;
use Padarom\UpdateServer\Models\Package;

class ListController extends Controller
{
    public function getFullList(Request $request)
    {
        $context = $this->isWCF($request) ? 'xml' : 'html';

        $packages = Package::all();

        $content = view($context . '.list')->with(compact('packages'));
        return $this->response($context, $content);
    }
}
