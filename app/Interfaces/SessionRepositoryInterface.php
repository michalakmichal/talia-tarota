<?php
namespace App\Interfaces;
use Illuminate\Support\Collection;
interface SessionRepositoryInterface
{
    public function getSessions() : Array;
}