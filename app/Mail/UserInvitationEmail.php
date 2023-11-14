<?php

namespace App\Mail;

use App\Models\Admin\UserInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class UserInvitationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $invitation;

    public function __construct(UserInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        // Check if the invitation is expired
        if ($this->invitation->expires_at && now()->gt($this->invitation->expires_at)) {
            // Optionally handle the case when the invitation is expired
            return $this->markdown('emails.invitation-expired');
        }

        return $this->markdown('emails.user-invitation')
            ->subject(__('Invitation Email'))
            ->with([
                'acceptUrl' => URL::signedRoute('register', ['token' => $this->invitation->token]),
            ]);
    }
}
