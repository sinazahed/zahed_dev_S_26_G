<?php
namespace App\Controllers\Api\V1;

use App\Controllers\Base\BaseController; 

use App\Core\Request;
use App\Models\ShoppingList;

class ListController extends BaseController
{

    public function index()
    {
        $data['lists']=ShoppingList::all();
        return json($data,200);
    }

    public function create(Request $request)
    {
        $request=$request->getParams();
        $request['id']=ShoppingList::create([
            'title'=>$request['title'],
        ]);
        return json($request,200);
    }

    public function delete(Request $request)
    {
        ShoppingList::delete($request->getRouteParams('id'));
        return json(['id'=>$request->getRouteParams('id')],200);
    }

    public function update(Request $request)
    {
        $params=$request->getParams();
        ShoppingList::update($request->getRouteParams('id'),[
            'title'=>$params['title'],
            'checked'=>$params['checked']
        ]);
        return json($params,200);
    }

}

