<?php

namespace App\Library\RentBook\Service;

use App\Library\RentBook\Repository\RentBookRepository;
use App\Products\Abstracts\Services\AbstractService;

class RentBookService extends AbstractService
{
    public function __construct(RentBookRepository $repository)
    {
        $this->repository = $repository;
    }

}