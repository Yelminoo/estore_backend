<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Orderlist;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    //list page from dashboard
    public function listPage()
    {

        $admin = User::where('role', 'user')

            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('admin.dashboard.userList', compact('admin'));

    }

    //list page from dashboard
    public function lowStockPage()
    {
        $pro = Product::where('stock', '<=', 10)->orderBy('stock', 'asc')->paginate(5);

        return view('admin.dashboard.lowStock', compact('pro'));

    }

    //low stock edit page
    public function stockEditPage($id)
    {
        $cat = Category::get();
        $p = Product::where('id', $id)->first();
        return view('admin.dashboard.stockEdit', compact('p', 'cat'));
    }

    //update only stocks
    public function stockUpdate(Request $request)
    {

        $this->updateValidation($request, 'update');
        $data = $this->getData($request);

        Product::where('id', $request->id)->update($data);
        return redirect()->route('dashboard#lowStockPage')->with(['updateSuccess' => 'updated Successfully']);

    }

    //Pending Order
    public function orderPage()
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->where('orders.status', 0)
            ->leftJoin('users', 'users.id', 'orders.user_id')
        // ->when(request('key'), function ($query) {
        //     $query->orWhere('orders.id', 'like', '%' . request('key') . '%')
        //         ->orWhere('users.name', 'like', '%' . request('key') . '%')
        //         ->orWhere('orders.order_code', 'like', '%' . request('key') . '%')
        //         ->orWhere('orders.status', 'like', '%' . request('key') . '%')
        //         ->orWhere('orders.total_price', 'like', '%' . request('key') . '%');
        // })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('admin.dashboard.order', compact('order'));
    }

    //details page
    public function pendingOrderDetails($orderCode)
    {

        $order = Orderlist::select('orderlists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image', 'products.unit_price')
            ->where('orderlists.order_code', $orderCode)
            ->leftJoin('users', 'users.id', 'orderlists.user_id')
            ->leftJoin('products', 'products.id', 'orderlists.product_id')
            ->get();

        return view('admin.dashboard.orderDetails', compact('order'));
    }
    //updateCheck only stock
    private function updateValidation(Request $request)
    {
        $validationRule = [
            'stock' => 'required',
        ];

        Validator::make($request->all(), $validationRule)->validate();

    }

    //get update data
    private function getData(Request $request)
    {
        return [

            'stock' => $request->stock,

        ];
    }
}
