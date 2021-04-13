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
        /*$sessions = Session::whereHas('users',function($q)  use($user_id) {
            return $q->where('users.id','=',$user_id);
        })->with('users', function ($q) use($user_id) { 
            return $q->where('users.id','!=',$user_id)->select('users.id'); //exclude owner, get participants' ids
        })->get(); */

        /* Get user sessions with participants identities
         * Extract unique identities
         * Return it
         */
        $sessions = $user->sessions()->with('users', function ($q) use ($user){ 
            $q->where('users.id', '!=', $user->id)->select('users.id');
        } )->get();
        //return dd($sessions->toJson(JSON_PRETTY_PRINT));
        //return $sessions->toJson();
        $uniqueUserList = $sessions->pluck('users')->flatten()->pluck('id')->unique()->values();
        //$unique_users = $sessions->users->flatten()->unique()->values();
        //$sessions = $user->sessions()->pluck('id');
        //$sessions['sessions'] = $sessions->map(function($e){return $e;});
        return ['sessions' => $sessions, 'user_list' => $uniqueUserList];

        /*return User::findOrFail($user_id)
        ->sessions()
        ->with( ['users' => function($q) use($user_id) {
            return $q->where('users.id','!=',$user_id)
                     ->with('image');
        }] )->get();*/
            /*
        return User::findOrFail($user_id)
        ->sessions()
        ->with( ['users' => function($q) use($user_id) {
            return $q->where('users.id','!=',$user_id)
                     ->with('image');
        }] )->get();
        */

        //return null;
        //return User::find(1)->with(['sessions.users.image'])->get();
        /*return Session::with(['users.image' => function($q) use($user_id){
            return $q->where('id','=', $user_id);
        }])->get();*/
        /*return User::find(1)
        ->sessions()
        ->with('users', function($q){
            return $q->where('user_id','!=',1)->with('image');
        })
        ->get();*/
        /*->with('users', function($q){
            return $q->where('id','!=',1)->with('image', function($query) {
                return $query;
            });
        })->get();*/
        /*return User::find(1)->sessions()->with('users', function($q){
            return $q->where('id','!=',1)->with('image', function($query) {
                return $query;
            });
        })->get();*/
        /*
        method with User::class  */
        /*
        return Session::whereHas('users', function($q){
            return $q->;
        })->get();*/
        /*return User::find($user_id)
        ->sessions()
        ->with(['users' => function($query) {
            $query->where('user_id', '!=', '1')->where('image', function($q){
                return 0;
            }); //albo dodac drugi el tablicy 'users.image'
        }])->get();*/
        
        /* lub whereHas <=> with + warunek <- pomocne w filtrowaniu 
        return Session::whereHas('users', function($q) {
            $q->where('users.id',2);
        })->with('users')->where('users.id','!=',2)->get(); */

        //Session::with(['']);
        //return User::find($user_id)->sessions()->with('users:name')->get();
        //return User::find($user_id)->sessions()->whereHas('users', function($q){
        //})->get();
        //return User::find($user_id)->sessions()->with('users:name')->get();
        //return User::with('sessions.users')->find($user_id);
        //return Session::with('users')->find(2);
        //return $sessions =  User::find($user_id)->sessions->get(1)->users;// User::find($user_id)->sessions;
        // znajdź sesje uzytkownika o podanym id
        // dla kazdej sesji znajdz wszystkich jej uzytkownikow
    }
}