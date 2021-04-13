<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Session;
use App\Models\Message;
use App\Models\Image;
use App\Models\User;

// zrobić implementację kazdego projektu dla aplikacji elektron ;-)

class UserRepository implements UserRepositoryInterface
{
    public function setUserLastSeen($user, $timestamp)
    {
        $user->last_seen= $timestamp;
        $user->save();
        return $user;
        //return User::with('image')->findMany($list->map(function($i){ return (Int)$i;})); // format data
        // check if formatting is needed
    }
    public function getUsersByList(Collection $list)
    {
        return User::with('image')->findMany($list->map(function($i){ return (Int)$i;})); // format data
        // check if formatting is needed
    }
}