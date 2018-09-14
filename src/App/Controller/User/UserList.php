<?php

namespace App\Controller\User;

use App\Controller\Base;
use Slim\Http\Request;
use Slim\Http\Response;

class UserList extends Base
{
    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function index(Request $request, Response $response)
    {
        $name = $request->getParam('User');
        $array = ['test' => "Hello, $name"];
        $json = json_encode($array);
        return $response->withHeader('ContentType', 'application/json')->withJson($json, 200);
    }
}
