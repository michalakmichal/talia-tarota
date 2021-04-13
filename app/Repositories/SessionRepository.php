<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Interfaces\SessionRepositoryInterface;
use App\Models\Session;
use App\Models\Offer;
use App\Models\SessionState;
use App\Models\User;

// zrobić implementację kazdego projektu dla aplikacji elektron ;-)

class SessionRepository implements SessionRepositoryInterface
{
    public function getSessions() : Array
    {
        $data['sessions'] = Session::all();
        $data['types'] = Offer::all();
        $data['states'] = SessionState::all();
        //Zwrócę sessions
        //sessions.users (imię, zdjęcie) ??
        //sessions.types
        return $data;//response()->json($sessions);
    }
    /*
        return a collection excluding session owner
    */
    public function getSession($id)
    {
        return Session::find($id);
    }
    public function createSession($data)
    {
        //refac: destrukturyzacja -> dodać cały obiekt $data + session_type = 1 - do niego
        $session = Session::create([
            'state_id' => 1,
            'offer_id' => $data['offer_id']
        ]);
        $session->users()->saveMany(User::find([$data['user_id'],11]));
        return $session;
    }
    public function deleteSession($id)
    {
        try{
            $session = Session::find($id);
        }
        catch(\Throwable $e)
        {
            report($e);
            return null;
        }
    }
    public function updateSession($session, $data)
    {
        $session->update($data);
        return $session;
    }
    public function getUserSessions($user)
    {
        /* Get user sessions with participants identities
         * Extract unique identities
         * Return it
         */
        $sessions = $user->sessions()->with('users', function ($q) use ($user){ 
          return $q->get();
            //  $q->where('users.id', '!=', $user->id)->select('users.id');
        } )->get();
        $uniqueUserList = $sessions->pluck('users')->flatten()->pluck('id')->unique()->values();
        return ['sessions' => $sessions, 'user_list' => $uniqueUserList];
    }
}