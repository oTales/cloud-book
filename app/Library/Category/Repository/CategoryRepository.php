<?php

namespace App\Library\Category\Repository;

use App\Models\Category;
use App\Products\Abstracts\Repositories\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

}
