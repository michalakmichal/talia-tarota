<?php

namespace App\Http\Controllers;
use App\Interfaces\CardRepositoryInterface;
use Illuminate\Http\Request;

class CardController extends Controller
{
    protected $repository;
    public function __construct(CardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    // S
    public function index(Request $request)
    {
        return $this->repository->getCards();
    }
    public function patch(Request $request, $id)
    {
        return $this->repository->updateCard($request->all(), $id);
    }
    public function show($id) //+Request np do autoryzacji itp.
    {
        return $this->repository->getCard($id);
    }
}
