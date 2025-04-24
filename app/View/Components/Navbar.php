<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $active;
    public $options;
    
    public function __construct($active)
    {
        $this->active = $active;
        $this->options = [
            [
                'key' => 'todos',
                'title' => 'Todo',
                'icon' => 'fa fa-table-list',
                'route' => route('todos.page')
            ],
            [
                'key' => 'pomodoro',
                'title' => 'Pomodoro',
                'icon' => 'fa fa-clock',
                'route' => route('pomodoro.page')
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
