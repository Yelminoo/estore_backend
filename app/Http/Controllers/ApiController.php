<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Orderlist;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    //register
    public function register(Request $request)
    {

        logger($request);
        $user = $this->getRegisterData($request);
        User::create($user);
        return response()->json([
            'user' => $request->name,
            'email' => $request->email,

        ], 200);
    }

    //log in
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // logger($user);
        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'id' => $user->id,
                    'token' => $user->createToken(time())->plainTextToken,
                ]);
            } else {
                return response()->json([
                    'token' => null,
                ]);
            }
        }
        return response()->json([
            'token' => null,
        ]);

    }

    //get all product
    public function product()
    {
        $product = Product::get();
        // logger($product);
        return response()->json([
            'product' => $product,
        ]);
    }

    //get all category
    public function category()
    {
        $category = Category::get();
        logger($category);
        return response()->json([
            'category' => $category,
        ]);

    }

    //get all cart
    public function cart(Request $request)
    {
        logger($request->u);
        $cart = Cart::where('user_id', $request->u)->get();
        logger($cart);
        return response()->json([
            'cart' => $cart,
        ]);
    }

    //get search category product
    public function categorySearch(Request $request)
    {
        if ($request->key == null) {
            $product = Product::get();
            return response()->json([
                'product' => $product,
            ]);
        } else {
            $product = Product::where('category_id', $request->key)->get();
            // logger($product);
            return response()->json([
                'product' => $product,
            ]);
        }

    }

    //get search product
    public function productSearch(Request $request)
    {

        if ($request->key == null) {
            $product = Product::get();
            return response()->json([
                'product' => $product,
            ]);
        } else {
            $product = Product::orWhere('id', $request->key)
                ->orWhere('name', 'like', '%' . $request->key . '%')
                ->orWhere('description', 'like', '%' . $request->key . '%')
                ->get();
            // logger($product);
            return response()->json([
                'product' => $product,
            ]);
        }

    }

    //for user acc page and nav info user start
    //get profile
    public function profile(Request $request)
    {
        $u = User::where('id', $request->u)->first();
        // logger($u);
        return response()->json([
            'profile' => $u,
        ]);

    }

    //update profile
    public function updateProfile(Request $request)
    {
        // logger($request);
        $update = $this->getUpdateData($request);
        // logger($update);
        User::where('id', $request->id)->update($update);
        $u = User::where('id', $request->id)->first();
        // logger($u);
        return response()->json([
            'profile' => $u,
        ]);

    }

    //upload image
    public function uploadImage(Request $request)
    {

        $file = $request->file;
        $fileName = 'account' . uniqid() . $file->getClientOriginalName();

        //store upload image
        $file->move(public_path() . '/ProjectImg', $fileName);

        //delete db name from public if exists
        $dbFile = User::where('id', $request->id)->first();
        $dbName = $dbFile['image'];

        if ($dbName != null) {
            if (File::exists(public_path() . '/ProjectImg/' . $dbName)) {
                File::delete(public_path() . '/ProjectImg/' . $dbName);
            }
        }

        $data = [
            'image' => $fileName,
        ];

        //update profile image
        User::where('id', $request->id)->update($data);

        return response()->json(
            [
                "response" => 'success',
            ]
        );
    }

    //for user acc page and nav info user end

    //for product details page start
    //details
    public function details(Request $request)
    {

        $product = Product::where('id', $request->id)->first();
        return response()->json([
            'product' => $product,
        ]);
    }

    //view count increase and sent to vue
    public function viewCount(Request $request)
    {

        $viewCount = Product::where('id', $request->id)->first();
        $NewViewCount = $viewCount->view_count + 1;
        $data = [
            'view_count' => $NewViewCount,
        ];
        Product::where('id', $request->id)->update($data);
        return response()->json([
            'response' => 'success',
        ]);

    }

    //add cart
    public function addCart(Request $request)
    {

        $data = $this->getCartData($request);

        Cart::create($data);
        return response()->json([
            'success' => 'add to cart success',
        ]);

    }

    //for product details page end
    //for cart page start
    // get cart for page
    public function cartPage(Request $request)
    {
        $cart = Cart::select('carts.*', 'products.name as product_name', 'products.image as image', 'products.unit_price as price', 'products.stock as instock')
            ->selectRaw('sum(carts.quantity) as cartqty')
            ->where('carts.user_id', $request->u)
            ->leftJoin('products', 'carts.product_id', 'products.id')
            ->groupBy('carts.product_id')
            ->get();

        logger($cart);
        return response()->json([
            'cart' => $cart,
        ]);
    }

    // add order
    public function addOrder(Request $request)
    {
        logger($request);
        $user = $request[0]['user_id'];
        logger($user);
        $total = 0;
        foreach ($request->all() as $item) {

            $data = Orderlist::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total_price' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            Product::where('id', $item['product_id'])->update(['stock' => $item['updateStock']]);

            $total += $data->total_price;
        };
        Cart::where('user_id', $request[0]['user_id'])->delete();
        Order::create([
            'user_id' => $request[0]['user_id'],
            'total_price' => $total + 3000,
            'order_code' => $data->order_code,
        ]);
        return response()->json([
            'message' => 'success',
            'status' => 'true',
        ], 200);

    }

    // for cartpage end

    //for order
    //get all pending order
    public function order(Request $request)
    {
        logger($request->u);
        $order = Order::where('user_id', $request->u)->where('status', 0)->get();
        logger($order);
        return response()->json([
            'order' => $order,
        ]);
    }

    //get order for order page
    public function orderPage(Request $request)
    {
        logger($request->u);
        $order = Order::select('orders.*', 'users.name as user_name')

            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->where('orders.user_id', $request->u)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'orderList' => $order,
        ]);
    }

    // for contact
    //contact
    public function contact(Request $request)
    {

        logger($request);
        $data = $this->getContactData($request);
        Contact::create($data);
        return response()->json(['sentSuccess' => 'success']);

    }

    private function getContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,

        ];
    }
    //contact end
    //register data
    private function getRegisterData(Request $request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ];
    }

    //update data
    private function getUpdateData(Request $request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
    }

    //cart data
    private function getCartData(Request $request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->qty,
        ];
    }

    //test paginate
    public function productPaginate(Request $request)
    {
        $product = Product::paginate(5);
        // logger($product);
        return response()->json([
            'product' => $product,
        ]);
    }
}
