<?php

namespace App\Controllers\Api\V1;

use App\Controllers\Base\BaseController;
use App\Core\Request;
use App\Models\ShoppingList;

class SearchController extends BaseController
{

    public function search(Request $request)
    {
        $text = $request->getRouteParam('text');
        $model = new ShoppingList();
        $data['result']=$model->like(['title'],$text);
        return json($data,200);
    }

}