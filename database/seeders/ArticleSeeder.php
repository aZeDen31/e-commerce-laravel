<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $user = User::first();

        if ($categories->isEmpty() || !$user) {
            return;
        }

        $articles = [
            [
                'article_name' => 'Smartphone Pro Max',
                'description' => 'Un smartphone puissant avec un écran OLED et triple caméra.',
                'price' => 999.99,
                'category' => 'Électronique',
                'image' => 'smartphone.jpg'
            ],
            [
                'article_name' => 'Casque Sans Fil',
                'description' => 'Réduction de bruit active et son haute fidélité.',
                'price' => 299.00,
                'category' => 'Électronique',
                'image' => 'headphones.jpg'
            ],
            [
                'article_name' => 'Ordinateur Gaming',
                'description' => 'Performances extrêmes pour les jeux et le travail.',
                'price' => 1499.00,
                'category' => 'Informatique',
                'image' => 'laptop.jpg'
            ],
            [
                'article_name' => 'Souris Ergonomique',
                'description' => 'Précision et confort pour vos sessions de travail.',
                'price' => 59.90,
                'category' => 'Informatique',
                'image' => 'mouse.jpg'
            ],
            [
                'article_name' => 'T-shirt Coton Bio',
                'description' => 'Doux, respirant et respectueux de l\'environnement.',
                'price' => 25.00,
                'category' => 'Mode',
                'image' => 'tshirt.jpg'
            ],
            [
                'article_name' => 'Jean Slim Fit',
                'description' => 'Un classique indémodable pour toutes les occasions.',
                'price' => 45.00,
                'category' => 'Mode',
                'image' => 'jeans.jpg'
            ],
            [
                'article_name' => 'Machine à Café Espresso',
                'description' => 'Le goût du vrai café italien chaque matin.',
                'price' => 199.00,
                'category' => 'Maison',
                'image' => 'coffee.jpg'
            ],
            [
                'article_name' => 'Lampe Design LED',
                'description' => 'Éclairage tamisé et moderne pour votre salon.',
                'price' => 89.00,
                'category' => 'Maison',
                'image' => 'lamp.jpg'
            ],
            [
                'article_name' => 'Roman de Science-Fiction',
                'description' => 'Un voyage épique vers des contrées lointaines.',
                'price' => 18.50,
                'category' => 'Livres',
                'image' => 'book.jpg'
            ],
            [
                'article_name' => 'Guide de Cuisine Saine',
                'description' => 'Recettes savoureuses pour une vie équilibrée.',
                'price' => 22.00,
                'category' => 'Livres',
                'image' => 'cookbook.jpg'
            ],
        ];

        foreach ($articles as $data) {
            $cat = $categories->where('name', $data['category'])->first();
            Article::create([
                'article_name' => $data['article_name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'article_image' => $data['image'],
                'category_id' => $cat ? $cat->id : null,
                'autor_id' => $user->id,
            ]);
        }
    }
}
