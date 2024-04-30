<?php
namespace App\Controllers\Base;
use App\Core\Request;

class BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}