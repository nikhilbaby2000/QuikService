<?php

namespace App\Jobs\Notifications;

use Log;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

abstract class BaseNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    abstract public function handle();

    /**
     * Get the Mailer instance.
     *
     * @return \Illuminate\Mail\Mailer
     */
    protected function mailer()
    {
        return app('mailer');
    }

    /**
     * Run a method safely ignoring any exceptions thrown.
     *
     * @param string $method
     * @param bool $throws
     * @return mixed|null
     * @throws Exception
     */
    protected function safeRun(string $method, bool $throws = false)
    {
        if (!method_exists($this, $method)) {
            throw new Exception('Notification method not found. [' . $method . '] [' . get_class($this). '].');
        }

        if ($throws) {
            return $this->$method();
        }

        return execute_and_ignore_exception(function () use ($method) {
            return $this->$method();
        }, function ($e) use ($method) {
            Log::error("[Notification failed] Error running '{$method}' method. Message: " . $e->getMessage());
        });
    }
}
