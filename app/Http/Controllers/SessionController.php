<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Interfaces\SessionRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Session;
use App\Models\User;
use App\Events\SessionCreated;
use App\Events\SessionStateChanged;

//use App\Models\SessionTypes;

class SessionController extends Controller
{
    protected $sessionRepository, $userRepository;
    public function __construct(SessionRepositoryInterface $sessionRepository,
                                UserRepositoryInterface $userRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
        $this->authorizeResource(Session::class, 'session');
    }
    public function index(Request $request)
    {
        return $this->sessionRepository->getSessions();
    }
    public function show(Request $request)
    {
        return $this->sesionRepository->getSession();
    }
    public function update(Request $request, Session $session)
    {
        $session = $this->sessionRepository->updateSession($session, $request->all());
        broadcast(new SessionStateChanged($session));
        return $session;
    }
    public function store(Request $request)
    {
        $session = $this->sessionRepository->createSession($request->all()['data']);
        $session->load('users');
        broadcast(new SessionCreated($session));//->toOthers();
        return $session;
    }
    public function delete(Request $request)
    {
        return $this->sessionRepository->destroySession();
    }
    //Requests from users, middleware users + auth
    public function getUserSessions(Request $request, User $user)
    {
        $data = $this->sessionRepository->getUserSessions($user);
        $data['unique_users'] = $this->userRepository->getUsersByList($data['user_list']);
        unset($data['user_list']);
        return collect($data)->toJson(JSON_PRETTY_PRINT);
    }
    
}
