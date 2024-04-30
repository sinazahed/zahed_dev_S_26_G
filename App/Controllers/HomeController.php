<?php
namespace App\Controllers;
use App\Controllers\Base\BaseController; 
use App\Models\User;

class HomeController extends BaseController
{
    public function index()
    {
        $users = User::find(1);
    }
}

