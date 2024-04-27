<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //ajax change role of user to admin by admin
    public function changeRole(Request $request)
    {
        logger($request->all());

        $data = User::where('id', $request->user_id)->first();

        User::where('id', $data->id)->update(['role' => 'admin']);

    }
    //ajax change role of admin to user by admin
    public function changeRoleUser(Request $request)
    {
        logger($request->all());

        $data = User::where('id', $request->user_id)->first();

        User::where('id', $data->id)->update(['role' => 'user']);

    }

    //delete user

    public function deleteUser(Request $request)
    {
        User::where('id', $request->user_id)->delete();
    }

    //delete category

    public function deleteCategory(Request $request)
    {
        Category::where('id', $request->category_id)->delete();

    }

    //order status update
    public function updateStatus(Request $request)
    {

        Order::where('id', $request->orderId)->update(['status' => $request->status]);

        return response()->json([
            'message' => 'succuess',
            'status' => 'true',
        ], 200);

    }

}