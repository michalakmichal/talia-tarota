<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

/*Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});*/
//Mogę tez utworzyc Klasę W App/Broadcasting/Nazwa_kanału

Broadcast::channel('user.{id}', function (User $user, $id) {
    return true;//(int) $user->id === (int) $id;
    //$user; //(int) $user->id === (int) $id;
});
Broadcast::channel('session.{id}', function (User $user, $id) {
    return true;//(int) $user->id === (int) $id;
    //$user; //(int) $user->id === (int) $id;
});

Broadcast::channel('global', function (User $user) {
    return (int) $user->id;
});
