<?php

namespace Padarom\UpdateServer\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function isWCF(Request $request)
    {
        if ($request->has('forceXML')) {
            return true;
        }

        $userAgent = $request->header('User-Agent');

        // HTTPRequests made with WCF's "HTTPRequest" class send this User-Agent:
        // HTTP.PHP (HTTPRequest.class.php; WoltLab Community Framework/2.1; de)
        return strpos($userAgent, 'HTTP.PHP') !== false;
    }

    public function response($type, $content)
    {
        switch ($type) {
            case 'xml':
                return response($content, '200')->header('Content-Type', 'text/xml');
            default:
                return $content;
        }
    }
}
