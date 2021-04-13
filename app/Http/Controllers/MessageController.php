<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Interfaces\MessageRepositoryInterface;
use App\Models\Session;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use App\Notifications\NewMessage;

//use App\Models\SessionTypes;

class MessageController extends Controller
{
    protected $repository;
    public function __construct(MessageRepositoryInterface $repository)
    {
        //$this->authorizeResource(Message::class, 'message');
        $this->repository = $repository;
    }
    /// ???
    public function index(Request $request)
    {
        return $this->repository->getSessions();
    }
    public function show(Request $request)
    {
        return $this->repository->getSession();
    }
    public function update(Request $request)
    {
        return $this->repository->updateSession();
    }
    //// ?
    public function store(Request $request, Session $session)
    {
        // jesli jestem adminem
        // z mojego konta tylko jako ja / z konta admina jako kazdy uzytkownik
        // jesli uczestnicze w konwersacji $request['data']['user_id']
        $this->authorize('create', [ Message::class, $session ]);
        $message = $this->repository->createMessage(
            $session, 
            auth()->user()->id, 
            $request->all() );

        // send emails
        broadcast(new MessageSent($message));//->toOthers();

        //send chat notifications
        $receivers = $session->users;
        foreach($receivers as $user)
        {
            $user->notify(new NewMessage($message));
        }
        return $message;
    }
    public function delete(Request $request)
    {
        return $this->repository->destroySession();
    }
    //Requests from users, middleware users + auth
    public function getSessionMessages(Request $request, Session $session)
    {
        //$this->authorize('view', $user);
        //return $user->sessions;
        //return $request->user()->id;
        //return auth()->user()->sessions;
        //$this->authorize('view', $request->user->sessions[0]);
        //$this->authorize('view', [$user, Session::class]);
        //if($request->id)
        //return $this->repository->getUserSessions($request->user()->id);
        return $this->repository->getSessionMessages($session->id);
    }
    
}
