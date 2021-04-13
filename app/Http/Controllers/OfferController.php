<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Interfaces\OfferRepositoryInterface;
use App\Models\User;


//use App\Models\SessionTypes;

class OfferController extends Controller
{
    protected $repository;
    public function __construct(OfferRepositoryInterface $repository)
    {
        $this->repository = $repository;
        //$this->authorizeResource(Session::class);
    }
    // Standard methods, middleware ... + admin auth
    public function index(Request $request)
    {
        return $this->repository->getOffers();
    }
    public function show(Request $request, $id)
    {
        return $this->repository->getOffer($id);
    }
    public function patch(Request $request, $id)
    {
        return $this->repository->updateOffer($request->all()['data'], $id);
    }
    
}
