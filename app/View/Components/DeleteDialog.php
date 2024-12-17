<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteDialog extends Component
{
    /**
     * Create a new component instance.
     */
    public $deleteId;

    public function __construct($deleteId)
    {
        $this->deleteId = $deleteId;
    }

    public function render()
    {
        return view('components.delete-dialog');
    }
}
