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
}
