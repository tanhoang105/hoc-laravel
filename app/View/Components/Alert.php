<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $content;
    public function __construct($type , $content)
    {
        // 
        $this->type = $type;
        $this->content = $content;
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    
    {
        return view('components.alert');
    }
}
