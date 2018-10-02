<?php

namespace App\Jobs\Notifications\Auth;

use App\Models\User;
use Illuminate\Mail\Message;
use App\QuikService\Constants\Queue\Queue;
use App\Jobs\Notifications\BaseNotification;

class EmailConfirmationNotification extends BaseNotification
{
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = Queue::PRIORITY;

    /**
     * The registered user.
     *
     * @var User
     */
    protected $user;

    /**
     * The email confirmation token.
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->safeRun('sendConfirmationEmail');
    }

    /**
     * Send the email confirmation mail.
     */
    protected function sendConfirmationEmail()
    {
        $data = ['user' => $this->user, 'token' => $this->token];

        $this->mailer()
            ->send('email.auth.email-confirmation', $data, function (Message $message) {
                $message->to($this->user->email);
                $message->subject('Confirm your email');
            });
    }
}
