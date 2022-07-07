<?php


 /* 
 classname - Mail/inviteCreated.php
 Author - Raveendra 
 release version - 1.0
 Description-  This Model is used for sending Invitation mails to Users
 Created date - Nov 2019 
 */
 

namespace App\Mail;

use App\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Invite $invite)
     {
            $this->invite = $invite;
     }



    /**
     * Build the message.
     *
     * @return $this
     */
     public function build()
     {
        //redirects to the Email View which has the mail content
        return $this->from('info@telunguviswakarma-tn.in')->subject('Invitation to connect in Viswakarma Community Website')->view('emails.invite', ['invite' => $this->invite]);   
      }



}



