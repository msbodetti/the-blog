<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Post extends Component
{
    public $id;
    public $userId;
    public $title;
    public $content;
    public $date;
    public $author;
    public $averageRating;

    /**
     * Create a new component instance.
     *
     * @param int $id
     * @param int $userId
     * @param string $title
     * @param string $content
     * @param string $date
     * @param string $author
     * @param int $averageRating
     */
    public function __construct(int $id, int $userId, string $title, string $content, string $date, string $author, int $averageRating)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->author = $author;
        $this->averageRating = $averageRating;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post');
    }
}
