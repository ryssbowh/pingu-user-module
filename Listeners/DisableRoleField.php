<?php

namespace Pingu\User\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisableRoleField
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->form->getName() == 'edit-model-role') {
            $event->form->getElement('name')->option('disabled', true);
        }
    }
}
