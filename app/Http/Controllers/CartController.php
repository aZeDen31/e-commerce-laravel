<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $userId = Auth::id();

        $cartItem = Cart::where('autor_id', $userId)
            ->where('article_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->article_number += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'autor_id' => $userId,
                'article_id' => $id,
                'article_number' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('article')->where('autor_id', $userId)->get();
        
        $total = 0;
        foreach ($cartItems as $item) {
            if ($item->article) {
                $total += $item->article->price * $item->article_number;
            }
        }

        return view('cart', compact('cartItems', 'total'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();
        $cartItem = Cart::where('autor_id', $userId)->where('cart_id', $id)->firstOrFail();
        
        $cartItem->article_number = $request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Quantité mise à jour !');
    }

    public function remove($id)
    {
        $userId = Auth::id();
        $cartItem = Cart::where('autor_id', $userId)->where('cart_id', $id)->firstOrFail();
        $cartItem->delete();

        return redirect()->back()->with('success', 'Article retiré du panier !');
    }
}
