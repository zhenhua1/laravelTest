<?php

namespace App\Http\Controllers\Api;


class MainController extends BaseController
{
    public function index()
    {
        return $this->error('这是首页');
    }
}
