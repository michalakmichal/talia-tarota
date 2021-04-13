<?php
namespace App\Interfaces;
use Illuminate\Support\Collection;
interface MessageRepositoryInterface
{
    public function getMessages() : Collection;
}