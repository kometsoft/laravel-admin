<?php

namespace App\Console\Commands;

use RuntimeException;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class InstallAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin UI resources.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->runCommands(['php artisan auth:install']);

        $this->callSilent('vendor:publish', ['--tag' => 'laravel-admin', '--force' => true]);
        
        $this->line('');
        $this->components->info('Admin UI installed successfully.');
    }

    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }
}
