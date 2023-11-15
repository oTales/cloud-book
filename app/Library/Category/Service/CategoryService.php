<?php

namespace App\Library\Category\Service;

use App\Library\Category\Repository\CategoryRepository;
use App\Products\Abstracts\Services\AbstractService;

class CategoryService extends AbstractService
{
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

}
