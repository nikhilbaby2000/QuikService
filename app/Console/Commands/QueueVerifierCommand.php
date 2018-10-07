<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class QueueVerifierCommand extends Command
{
    const COMMANDS = [
        'queue:work' => [
            'params' => [
                'queue' => 'priority',
                'sleep' => '1',
                'tries' => '1',
                'daemon',
            ]
        ]
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:queue {queue? : Queue name to check} {--b= : Should it be ran in background}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify if a queue is running';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $queue = $this->argument('queue');
        $background = !is_null($b = $this->option('b')) ? (bool) $b : true;

        $runningData = process_list($queue);

        if (!empty($queue) && empty($runningData)) {

            $parameters = [];
            foreach (data_get(self::COMMANDS, "{$queue}.params", []) as $key => $value) {
                $parameters[] = is_int($key) ? "--{$value}" : "--{$key}={$value}";
            }

            $paramString = implode(' ', $parameters);
            $argString = implode(' ', data_get(self::COMMANDS, "{$queue}.argv", []));
            $backgroundString = $background ? "> /dev/null 2>&1" : '';

            return shell_exec("php artisan {$queue} {$argString} {$paramString} {$backgroundString}");
        }

        return $runningData;
    }
}