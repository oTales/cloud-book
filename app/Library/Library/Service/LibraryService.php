<?php

namespace App\Library\Library\Service;

use App\Library\Library\Repository\LibraryRepository;
use App\Products\Abstracts\Services\AbstractService;

class LibraryService extends AbstractService
{
    public function __construct(LibraryRepository $repository)
    {
        $this->repository = $repository;
    }
}
