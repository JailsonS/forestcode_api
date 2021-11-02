<?php
namespace Src\Application\Controllers;

use Src\Application\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $response = [];

        $response['error'] = '404';

        return $this->returnJson($response);
    }
}