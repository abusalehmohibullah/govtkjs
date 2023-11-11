<?php

namespace App\Mail;

use App\Models\Admin\UserInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

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
            return $this->view('emails.invitation-expired');
        }

        return $this->view('emails.user-invitation')
            ->subject('Invitation Email')
            ->with([
                'token' => $this->invitation->token,
                // Add other data as needed
            ]);
    }
}
