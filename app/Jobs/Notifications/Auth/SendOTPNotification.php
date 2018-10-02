<?php

namespace App\Jobs\Notifications;

use Illuminate\Mail\Message;
use App\Jobs\Notifications\BaseNotification;

class SendOTPNotification extends BaseNotification
{
    /**
     * @var string
    */
    protected $otp;

    /**
     * @var string
    */
    protected $mobile;

    public function __construct(string $otp, $mobile)
    {
        $this->otp = $otp;
        $this->mobile = $mobile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->safeRun('sms');
    }

    /**
     * Send SMS.
     */
    protected function sms()
    {
        $message = sms_template('login-otp', ['otp' => $this->otp]);

        sms()->send($this->mobile, $message);
    }

}
