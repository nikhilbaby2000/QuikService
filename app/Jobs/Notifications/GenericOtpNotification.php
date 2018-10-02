<?php

namespace App\Jobs\Notifications;

use App\QuikService\Constants\Queue\Queue;

class GenericOtpNotification extends BaseNotification
{
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = Queue::PRIORITY;

    /**
     * The mobile number.
     *
     * @var string
     */
    protected $mobile;

    /**
     * The otp.
     *
     * @var string
     */
    protected $otp;

    /**
     * Create a new job instance.
     *
     * @param string $mobile
     * @param string $otp
     */
    public function __construct($mobile, $otp)
    {
        $this->mobile = $mobile;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->safeRun('sendOtpSms');
    }

    /**
     * Send the otp sms.
     */
    protected function sendOtpSms()
    {
        $to = $this->mobile;

        $message = sms_template('generic-otp', ['otp' => $this->otp]);

        sms()->send($to, $message);
    }
}
