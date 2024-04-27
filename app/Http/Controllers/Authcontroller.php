<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    //

    public function registerPage()
    {
        return view('register');
    }

    public function loginPage()
    {
        return view('login');
    }
    public function dashboardPage()
    {

        if (Auth::user()->role == 'admin') {

            $u = User::where('role', 'user')->get();

            $c = Category::get();

            $p = Product::where('stock', '<=', 10)->orderBy('stock', 'asc')->get();

            $o = Order::where('status', 0)->get();

            $contact = Contact::get();

            return view('dashboard', compact('u', 'c', 'p', 'o', 'contact'));

        } else {
            return redirect()->route('user#accountDetails');
        }

    }
}
