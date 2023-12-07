<?php

namespace App\Library\Book\Repository;

use App\Library\Abstracts\Repositories\AbstractRepository;
use App\Models\Book;

class BookRepository extends AbstractRepository
{
    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function showBooksUser($userId,$params = null, $with = [])
    {
        return $this->getModel()->query()->with($with)->select('books.*','rent_books.*')
            ->join('rent_books', 'books.id', '=', 'rent_books.book_id')
            ->where('rent_books.user_id', $userId)->paginate(10)->withQueryString();
    }
}
