<?php

namespace App\Http\Controllers;

use App\Library\RentBook\Repository\RentBookRepository;
use App\Library\RentBook\Service\RentBookService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RentBookController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->repository = app(RentBookRepository::class);
}
}
