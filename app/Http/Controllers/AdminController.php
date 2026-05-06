<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Order;
use App\Models\User;
use App\Models\Coupon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $productsCount = Article::count();
        $ordersCount = Order::count();
        $usersCount = User::count();
        $couponsCount = Coupon::count();

        return view('admin.dashboard', compact('productsCount', 'ordersCount', 'usersCount', 'couponsCount'));
    }
}
