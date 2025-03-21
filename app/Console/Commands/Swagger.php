<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Swagger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:swagger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        @unlink(base_path().'/storage/temp_documentation.json');
        @unlink(base_path().'/storage/documentation.json');
        if (Artisan::call('test') == 0 && Artisan::call('swagger:push-documentation') == 0) {
            $this->info('Документация создана');

            return 0;
        }

        return 1;
    }
}
