<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Message;
use Mail;
use App\Mail\MessageReceivedMail;

class NewMessage extends Notification
{
    use Queueable;
    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        $to_name = 'Michał';
        $to_email = 'bok.codeservices@gmail.com';
        $data = array('name'=>$to_name, 
                      'body' => 'Uzytkownik '.$this->message->user->name.' wysłał Ci wiadomość. ('
                      .$this->message->created_at.') <br \>'
                      .'<span> <a href="taliatarota.pl"> <br> Przejdź do konwersacji </br> </a> </span>'  );
        Mail::to($to_email, $to_name)
        //->from('bok.codeservices@gmail.com','Test Mail')
        ->send(new MessageReceivedMail($data));
         /*, $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Laravel Test Mail');
        $message->from('bok.codeservices@gmail.com','Test Mail');
        });*/
        return new BroadcastMessage([
            'message_id' => $this->message->id,
            'sent_at' => $this->message->created_at,
            'session_id' => $this->message->session_id,
            'user_name' => $this->message->user->name
        ]);
    }
}
