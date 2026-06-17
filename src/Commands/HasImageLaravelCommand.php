<?php

namespace RPWebDevelopment\HasImageLaravel\Commands;

use Illuminate\Console\Command;

class HasImageLaravelCommand extends Command
{
    public $signature = 'has-image-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
