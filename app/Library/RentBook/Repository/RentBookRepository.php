<?php

namespace App\Library\RentBook\Repository;

use App\Models\RentBook;
use App\Library\Abstracts\Repositories\AbstractRepository;

class RentBookRepository extends AbstractRepository
{
    public function __construct(RentBook $model)
    {
        $this->model = $model;
    }

}
