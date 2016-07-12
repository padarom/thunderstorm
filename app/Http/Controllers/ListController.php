<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;

class ListController extends Controller
{
    public function getFullList(Request $request)
    {
        $context = $this->isWCF($request) ? 'xml' : 'html';

        $packages = [
            new Package([
                'identifier' => 'io.padarom.server', 
                'author' => 'Christopher Mühl',
                'authorurl' => 'https://padarom.io',
            ]),
            new Package([
                'identifier' => 'io.padarom.server2', 
                'author' => 'Christopher Mühl',
                'authorurl' => 'https://padarom.io',
            ]),
        ];

        $content = view($context . '.list')->with(compact('packages'));
        return $this->response($context, $content);
    }
}
