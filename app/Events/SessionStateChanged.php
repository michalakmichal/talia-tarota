<?php
// Trigerred when privilegged user has changed session state
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Session;

class SessionStateChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    protected $session;
    // only public props will be broadcasted:
    public $id, $state_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->state_id = $session->state_id;
        $this->id = $session->id;
    }
    /**
     * Get the channels, which event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     // Broadcast this event only to the users that participate in this session 
    public function broadcastOn()
    {
        $channels = [];  
        $participants = $this->session->users;
        foreach ($participants as $user) {
            array_push($channels, new PrivateChannel('user.' . $user->id));
        }
        return $channels;
    }
}
