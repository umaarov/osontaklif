<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    assert($this instanceof ClosureCommand);
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
