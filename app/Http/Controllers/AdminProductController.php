<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Article::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',
            'article_image' => 'nullable|url'
        ]);

        $data = $request->all();
        $data['autor_id'] = \Illuminate\Support\Facades\Auth::id();
        Article::create($data);
        
        return redirect()->route('admin.products.index')->with('success', 'Produit ajouté.');
    }

    public function edit($id)
    {
        $product = Article::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'article_name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',
            'article_image' => 'nullable|url'
        ]);

        $product = Article::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy($id)
    {
        $product = Article::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé.');
    }
}
