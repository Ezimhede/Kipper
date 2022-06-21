<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use http\Client\Response;
use Illuminate\Http\Request;

class ItemController extends Controller
{
//    /api/items
    public function index()
    {
        return Item::all();
    }

//    /api/items/id
    public function show($id)
    {
        $item = Item::find($id);

        if ($item == null) return response('404 Not Found');
        else return $item;
    }

    //    /api/items
    public function store(Request $request)
    {
        return Item::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return $item;
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return 204;
    }
}
