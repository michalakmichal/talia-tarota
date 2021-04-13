<?php
namespace App\Interfaces;
use Illuminate\Support\Collection;

interface CardRepositoryInterface
{
    public function getCards() : Collection;
}