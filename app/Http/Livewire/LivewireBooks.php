<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;

class LivewireBooks extends Component
{
    public $searchTerm = ' ';
    public $books;
    public function render()
    {
        $this->books = Book::where('title');
        return view('livewire.livewire-books',);
    }
}
