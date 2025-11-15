<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\NavigationLink;

class NavigationComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $navigationLinks = NavigationLink::orderBy('order')->get();
        $view->with('navigationLinks', $navigationLinks);
    }
}