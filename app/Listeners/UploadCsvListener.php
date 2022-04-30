<?php

namespace App\Listeners;

use App\Actions\CustomImportCsv;
use App\Events\FlagCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UploadCsvListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CustomImportCsv $importCsv)
    {
        $this->importCsv = $importCsv;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FlagCreatedEvent  $event
     * @return void
     */
    public function handle(FlagCreatedEvent $event)
    {
        $this->importCsv->execute($event->flag);
    }
}
