<?php

namespace App\Livewire;

use \App\Models\Article;
use Livewire\Component;

class BlogDetail extends Component
{

    public $blogID = null;

    public function mount($id) {
        $this -> blogID = $id;
    }

    public function render()
    {
        $article = Article::select('articles.*', 'categories.name as category_name')->leftJoin('categories', 'categories.id', 'articles.category_id')
                    ->findOrFail($this->blogID);
        return view('livewire.blog-detail', [
            'article' => $article
        ]);
    }
}
