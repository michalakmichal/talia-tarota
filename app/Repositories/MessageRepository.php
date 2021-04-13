<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Interfaces\MessageRepositoryInterface;
use App\Models\Session;
use App\Models\Message;
use App\Models\Image;
use App\Models\Card;
use App\Models\User;

// zrobić implementację kazdego projektu dla aplikacji elektron ;-)

class MessageRepository implements MessageRepositoryInterface
{
    public function getMessages() : Collection
    {
        $messages = Message::with('cards')->all();
        return $messages;//response()->json($sessions);
    }
    /*
        return a collection excluding session owner
    */
    public function getMessage($id)
    {
        return Message::with('cards')->find($id);
    }
    public function createMessage(Session $session, $user_id, $payload)
    {
        $payload = $payload['data'];
        $content = $payload['formData']['content'];
        $type_id = $payload['type_id'];
        $message = $session->messages()->create([
            'content' => $content,
            'type_id' => $type_id,
            'user_id' => $user_id,
        ]);
        // If message contains cards, attach them to it.
        if(isset($payload['formData']['selectedCardList'])) 
        { $message->cards()->attach($payload['formData']['selectedCardList']); }

        return $message->load('type');
    }
    public function deleteMessage($id)
    {
        try{
            $session = Message::find($id);
        }
        catch(\Throwable $e)
        {
            report($e);
            return null;
        }
    }
    public function getSessionMessages($session_id) : ?Collection
    {
        try{
        return Session::findOrFail($session_id)->messages()->with(['type', 'cards'])->get();
        }
        catch(\Throwable $e)
        {
            report($e);
            return null;
        }
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