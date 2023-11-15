<?php

namespace App\Library\User\Service;

use App\Library\User\Repository\UserRepository;
use App\Products\Abstracts\Services\AbstractService;

class UserService extends AbstractService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}
