<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Article::query();

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Sort by price
        if ($request->has('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $articles = $query->get();
        $categories = \App\Models\Category::all();

        return view('products', [
            'articles' => $articles,
            'categories' => $categories,
            'selectedCategory' => $request->category,
            'selectedSort' => $request->sort
        ]);
    }
}
