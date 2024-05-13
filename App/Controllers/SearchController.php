<?php
namespace App\Controllers;

use App\Controllers\Base\BaseController;
use App\Core\Request;
use App\Models\ShoppingList;
use App\Models\User;

class SearchController extends BaseController
{
    public function search(Request $request)
    {
        $text = $request->getRouteParam('text');
        $model = new ShoppingList();
        $res=$model->like(['title'],$text);
        echo json_encode($res);
    }
}