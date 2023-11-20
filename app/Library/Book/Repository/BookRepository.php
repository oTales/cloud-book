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
}
