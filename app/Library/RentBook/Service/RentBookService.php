<?php

namespace App\Library\RentBook\Service;

use App\Library\RentBook\Repository\RentBookRepository;
use App\Library\Abstracts\Services\AbstractService;
use Carbon\Carbon;

class RentBookService extends AbstractService
{
    public function __construct(RentBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function saveRentBook(array $data, $bookId = null, $userId = null)
    {
        $dataNowCarbon= Carbon::now(new \DateTimeZone('America/Sao_Paulo'));
        $data['rented_at'] = $dataNowCarbon->toDateString();
        $data['user_id'] = $userId;
        $data['book_id'] = $bookId;
        return $this->save($data);
    }

    public function deleteRentBook($id)
    {
        return $this->delete($id);
    }
}
