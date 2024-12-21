<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;  // Importation de LengthAwarePaginator

class BlogController extends Controller
{
    // Mise à jour du type de retour pour accepter LengthAwarePaginator
    public function index(): LengthAwarePaginator
    {
        return \App\Models\Post::paginate(25);  // paginate retourne un LengthAwarePaginator
    }

    public function show(string $slug, string $id): RedirectResponse | Post
    {
        $post = \App\Models\Post::findOrFail($id);
        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return $post;
    }
}
