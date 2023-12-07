<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminBookController extends Controller
{
    public function index()
    {
        $books = $this->repository->all();
        return Inertia::render('AdminBookIndex', [
            'books' => $books->items()
        ]);
    }
}
