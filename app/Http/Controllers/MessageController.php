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
    public function getSessionMessages(Request $request, Session $session)
    {
        $this->authorize('view', [ Message::class, $session ]);
        return $this->repository->getSessionMessages($session->id);
    }
    
}
