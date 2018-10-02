<?php

namespace App\Jobs\Notifications\Common;

use App\Models\Payment;
use Illuminate\Mail\Message;
use App\Jobs\Notifications\BaseNotification;

class PaymentErrorNotification extends BaseNotification
{
    /**
     * The payment model.
     *
     * @var Payment
     */
    protected $payment;

    /**
     * The error message.
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param Payment $payment
     * @param string $message
     */
    public function __construct(Payment $payment, string $message)
    {
        $this->payment = $payment;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->safeRun('sendAdminAlertEmail');
    }

    /**
     * Send the admin alert email.
     */
    protected function sendAdminAlertEmail()
    {
        $data = [
            'payment'   => $this->payment,
            'user'      => $this->payment->user,
            'message'   => $this->message
        ];

        $this->mailer()
            ->send('email.common.payment-error', $data, function (Message $message) {
                $message->to(admin_info()->email());
                $message->subject('Payment Processing Failed');
            });
    }
}
