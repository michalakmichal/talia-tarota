<?php

namespace App\Traits;
use App\Models\User;
use Illuminate\Auth\Access\Response;


trait AdminAuth {
    public function before(User $user)
    {
       
       if($user->isAdministrator()) return Response::allow();
       //: Response::deny('Only administrator is able to excute this action.'); !!! it would deny all request
    }
}