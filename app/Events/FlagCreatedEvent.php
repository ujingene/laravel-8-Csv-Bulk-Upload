<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FlagCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $flag;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($flag)
    {
        $this->flag = $flag;
    }
}
