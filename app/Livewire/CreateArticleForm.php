<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateArticleForm extends Component
{

    #[Validate('required|min:5')]
    public $title;
    #[Validate('required|min:10')]
    public $description;
    #[Validate('required|numeric')]
    public $price;
    #[Validate('required')]
    public $category_id;
    public $article;

    public function store(){
        $this->validate();
        $this->article = Article::create([
            'title'=> $this->title,
            'description' => $this->description,
            'price'=> $this->price,
            'category_id'=> $this->category_id,
            'user_id'=> Auth::id()
        ]);

        $this->cleanForm();

        session()->flash('success', 'Articolo creato con successo.');

    }

    public function cleanForm(){
        $this->title = '';
        $this->description = '';
        $this->category_id = '';
        $this->price = '';
    }


    public function render()
    {
        return view('livewire.create-article-form');
    }
}