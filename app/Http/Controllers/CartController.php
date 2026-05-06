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

    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::with('article')->where('autor_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            if ($item->article) {
                $total += $item->article->price * $item->article_number;
            }
        }

        if ($user->solde < $total) {
            return redirect()->back()->with('error', 'Solde insuffisant pour passer la commande. Veuillez recharger votre compte.');
        }

        // Déduire le solde
        $user->solde -= $total;
        $user->save();

        // Créer la commande
        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'en attente',
        ]);

        // Ajouter les articles à la commande
        foreach ($cartItems as $item) {
            if ($item->article) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'article_id' => $item->article_id,
                    'quantity' => $item->article_number,
                    'price' => $item->article->price,
                ]);
            }
        }

        // Vider le panier
        Cart::where('autor_id', $user->id)->delete();

        return redirect()->route('profile')->with('success', 'Votre commande a été passée avec succès !');
    }
}
