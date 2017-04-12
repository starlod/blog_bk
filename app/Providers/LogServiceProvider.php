<?php

namespace App\Providers;

use Illuminate\Log\Writer;
use Illuminate\Log\LogServiceProvider as ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Configure the Monolog handlers for the application.
     *
     * @param  \Illuminate\Log\Writer  $log
     * @return void
     */
    protected function configureDailyHandler(Writer $log)
    {
        $log->useDailyFiles(
            $this->app->storagePath() . '/logs/' . get_current_user() . '.log', $this->maxFiles(),
            $this->logLevel()
        );
    }
}
