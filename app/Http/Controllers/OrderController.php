<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderlist;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //list Page
    public function listPage()
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->when(request('key'), function ($query) {
                $query->orWhere('orders.id', 'like', '%' . request('key') . '%')
                    ->orWhere('users.name', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.order_code', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.status', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.total_price', 'like', '%' . request('key') . '%');
            })->orderBy('id', 'desc')
            ->paginate(5);

        return view('admin.order.listPage', compact('order'));
    }

    //filter status
    public function filterList(Request $request)
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->when(request('key'), function ($query) {
                $query->orWhere('users.name', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.order_code', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.total_price', 'like', '%' . request('key') . '%')

                ;
            });

        if ($request->status == null) {
            $order = $order

                ->orderBy('id', 'desc')
                ->paginate(5);
        } else {
            $order = $order
                ->where('orders.status', $request->status)
                ->orderBy('id', 'desc')
                ->paginate(5);
        };

        return view('admin.order.listPage', compact('order'));

    }

    //details page
    public function details($orderCode)
    {

        $order = Orderlist::select('orderlists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image', 'products.unit_price')
            ->where('orderlists.order_code', $orderCode)
            ->leftJoin('users', 'users.id', 'orderlists.user_id')
            ->leftJoin('products', 'products.id', 'orderlists.product_id')
            ->get();

        return view('admin.order.detailsPage', compact('order'));
    }

}
