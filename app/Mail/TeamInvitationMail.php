<?php

namespace App\Mail;

use App\Models\Team;
use App\Models\TeamInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Team $team;
    public TeamInvitation $invitation;
    public string $inviterName;

    /**
     * Create a new message instance.
     */
    public function __construct(Team $team, TeamInvitation $invitation, string $inviterName)
    {
        $this->team = $team;
        $this->invitation = $invitation;
        $this->inviterName = $inviterName;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject("Undangan bergabung ke tim {$this->team->name}")
            ->view('emails.team-invitation');
    }
}
