<?php

namespace App\Http\Controllers;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Jobs\CheckIfUserIsActive;
use App\Jobs\test;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
        //$this->authorizeResource(Session::class);
    }
    public function setUserLastSeen(Request $request, User $user) //rename by collection??
    {
        echo $this->repository->setUserLastSeen($user, Carbon::now());
        // trigger a checking job if it's not been fired recently
        if(!$user->activity_checked)
        {
            //CheckIfUserIsActive::dispatch($user)->delay(Carbon::now()->addMinutes(2));
            CheckIfUserIsActive::dispatch($user);
        }// jeśli od ostatniego zadania minelo >= 2 min włącz sprawdzanie aktywności uzytkownika
            // ewnetualnie dodac kolumne activity_checked zmieniana na zakonczenie job
        
        
    }
    public function getUsersByList(Request $request) //rename by collection??
    {

        //$this->authorize('view', $user);
        //return $user->sessions;
        //return $request->user()->id;
        //return auth()->user()->sessions;
        //$this->authorize('view', $request->user->sessions[0]);
        //$this->authorize('view', [$user, Session::class]);
        //if($request->id)
        //return $this->repository->getUserSessions($request->user()->id);
        return $this->repository->getUsersByList(collect($request->list));
    }
  /*  public function setUserActivity(Request $request)
    {
       // $this->authorize('setUserActivity', [Message::class,$request['data']['user_id']]);
        //$message = $this->repository->createMessage($request->all());
    } */
}
