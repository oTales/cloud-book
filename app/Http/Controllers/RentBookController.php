<?php

namespace App\Http\Controllers;

use App\Library\RentBook\Repository\RentBookRepository;
use App\Library\RentBook\Service\RentBookService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RentBookController extends AbstractController
{
    protected $service;

    public function __construct()
    {
        $this->service = app(RentBookService::class);
        $this->repository = app(RentBookRepository::class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|integer',
            'book_id' => 'nullable|integer',
            'rented_at' => 'nullable|date',
            'returned_at' => 'required|date',
        ]);
        $this->service->saveRentBook($request->toArray(), $request->id,auth()->user()->id);
    }
}
