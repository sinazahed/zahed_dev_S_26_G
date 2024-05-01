<?php
namespace App\Controllers;
use App\Controllers\Base\BaseController; 

use App\Core\Request;
use App\Models\ShoppingList;

class ListController extends BaseController
{

    public function index(Request $request)
    {
        $data['lists']=ShoppingList::all();
        view('list',$data);
    }

    public function create(Request $request)
    {
        $request=$request->getParams();
        ShoppingList::create([
            'title'=>$request['title'],
        ]);
        return redirectBack();
    }

    public function delete(Request $request)
    {
        ShoppingList::delete($request->getRouteParams('id'));
        return redirectBack();
    }

    public function update(Request $request)
    {
        $params=$request->getParams();
        ShoppingList::update($request->getRouteParams('id'),[
            'title'=>$params['title']
        ]);
        return redirectBack();
    }

    public function toggle(Request $request)
    {
        $params=$request->getParams();
        ShoppingList::update($params['id'],[
            'checked'=>$params['checked']
        ]);
    }
}

