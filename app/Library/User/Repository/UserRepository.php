<?php

namespace App\Library\User\Repository;

use App\Models\User;
use App\Products\Abstracts\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
