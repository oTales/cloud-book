<?php

namespace App\Library\Library\Repository;

use App\Models\Library;
use App\Products\Abstracts\Repositories\AbstractRepository;

class LibraryRepository extends AbstractRepository
{
    public function __construct(Library $model)
    {
        $this->model = $model;
    }
}
