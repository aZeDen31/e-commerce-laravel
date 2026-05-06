<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('items.article')->orderBy('created_at', 'desc')->get();
        return view('profile', compact('user', 'orders'));
    }

    public function addBalance(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();
        $user->solde += $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Votre solde a été rechargé de ' . number_format($request->amount, 2) . ' €.');
    }
}
