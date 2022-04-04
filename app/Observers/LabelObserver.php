<?php

namespace App\Observers;

use App\Models\Label;
use App\Helpers;

class LabelObserver
{
    /**
     * Handle the Label "creating" event.
     *
     * @param  \App\Models\Label  $label
     * @return void
     */
    public function creating(Label $label)
    {
        $label->url = Helpers::convertToUrl($label->name);
    }

    /**
     * Handle the Label "updating" event.
     *
     * @param  \App\Models\Label  $label
     * @return void
     */
    public function updating(Label $label)
    {
        $label->url = Helpers::convertToUrl($label->name);
    }

    /**
     * Handle the Label "deleted" event.
     *
     * @param  \App\Models\Label  $label
     * @return void
     */
    public function deleted(Label $label)
    {
        //
    }

    /**
     * Handle the Label "restored" event.
     *
     * @param  \App\Models\Label  $label
     * @return void
     */
    public function restored(Label $label)
    {
        //
    }

    /**
     * Handle the Label "force deleted" event.
     *
     * @param  \App\Models\Label  $label
     * @return void
     */
    public function forceDeleted(Label $label)
    {
        //
    }
}
