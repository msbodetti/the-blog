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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $id, int $userId, string $title, string $content, string $date, string $author)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->author = $author;
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
