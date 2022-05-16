<?php

namespace App\Http\Controllers;

use App\Mail\Subscribe;
use DateInterval;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Integer;

class ItemsController extends Controller
{
    // GET /index
    public function index()
    {
//        Mail::send(['text' => 'mail'],['name' =>'Ezimhede'],function($message){
//            $message->to('ezimhede47@gmail.com','To ezimhede')->subject('Kipper');
//            $message->from('ezimhede47@yahoo.com','Ezimhede');
//        });

        $userId = Auth::id();
        $items = Item::all()->where("user_id", "==", $userId);
        $categories = Category::all();
        return view('\Items\index', ["data" => $items, "categories" => $categories]);
    }

    // POST
    public function add(Request $request)
    {
        // Validation for form
        $validate = $request->validate([
            'name' =>'required',
            'category' => 'required',
            'expiry' => 'required|date',
            'notification' => 'required|digits_between:1,500',
            'userId' => 'nullable',
        ]);

        $item = new Item();
        $item->name = $request->input('name');
        $item->expiry_date = $request->input('expiry');
        $item->notification = $request->input('notification');
        $item->category_id = $request->category;
        $item->user_id = $request->input('userId');

        $expiry = $request->input('expiry');
        $expiry = Carbon::create($expiry);
        $notification = $request->input('notification');
        $item->notification_date = $expiry->subDays($notification);
        $item->isNotified = false;

        $item->save();
        $request->session()->flash('status', 'item created successfully');
        return redirect('index');
    }

    // GET /edit/1
    public function edit($id)
    {
        $item = Item::all()->where("id", "==", "$id");

//        return response()->json($item);
        return json_encode($item);
    }

    //POST save an edited item
    public function save(Request $request)
    {
        $item = Item::find($request->item_Id);
        $item->name = $request->input('name_edit');
        $item->expiry_date = $request->input('expiry_edit');
        $item->notification = $request->input('notification_edit');
        $item->category_id = $request->category_edit;
//        $item->user_id = $request->input('userId');
        $expiry = $request->input('expiry_edit');
        $expiry = Carbon::create($expiry);
        $notification = $request->input('notification_edit');
        $item->notification_date = $expiry->subDays($notification);
        $item->isNotified = false;

        $item->save();
        $request->session()->flash('status', 'item edited successfully');
        return redirect('index');
    }

    // Delete /delete/1
    public function delete($id)
    {
        $item = Item::find($id);

        $item->delete();
        session()->flash('status', 'item deleted successfully');
        return redirect('index');
    }
}
