<?php

namespace App\View\Components;

use App\Models\Posts;
use Illuminate\View\Component;

class Rating extends Component
{
    public $averageRating;
    public $id;

    /**
     * Create a new component instance.
     *
     * @param int $averageRating
     * @param int $id
     */
    public function __construct(int $averageRating, int $id)
    {
        $this->averageRating = $averageRating;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rating');
    }
}
