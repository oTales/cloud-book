<?php

namespace App\Http\Controllers;

use App\Library\Book\Repository\BookRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    public function __construct()
    {
        $this->repository = app(BookRepository::class);
    }

    public function index()
    {
        $books = $this->repository->all();
         return Inertia::render('Dashboard', [
            'books' => $books->items()
        ]);
    }

    public function show($id)
    {
        $book = $this->repository->find($id);
        return Inertia::render('BookDetails', [
            'book' => $book
        ]);
    }
}
