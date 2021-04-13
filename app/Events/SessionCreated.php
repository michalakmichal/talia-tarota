<?php
// Trigerred when new session has been created

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Session;

class SessionCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $session;
    /**
     * Create a new event instance.
     *
     * @return void
     */

     // Assign created session to broadcasted props
    public function __construct(Session $session)
    {
        $this->session = $session;
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
