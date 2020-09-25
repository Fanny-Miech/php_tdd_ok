<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\Donation;
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationShippedAuthor extends Mailable
{
    use Queueable, SerializesModels;

    private $project;
    public $donation;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Donation $donation)
    {
        $this->project = $donation->project;
        $this->donation = $donation;
        $this->user = $donation->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.donations.shipped.author')
                    ->with([
                        'projectTitle' => $this->project->title,
                        'donationAmount' => $this->donation->amount,
                        'userName' => $this->user->name,
                        'authorName' => $this->project->user->name
                    ]);

    }
}
