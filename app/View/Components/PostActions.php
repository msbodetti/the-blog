<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostActions extends Component
{
    public $id;
    public $userId;

    /**
     * Create a new component instance.
     *
     * @param int $id
     * @param int $userId
     */
    public function __construct(int $id, int $userId)
    {
        $this->id = $id;
        $this->userId = $userId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-actions');
    }
}
