<?php

namespace App\View\Components;

use App\Enums\OrderStatus;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public OrderStatus $status;

    /**
     * Create a new component instance.
     *
     * @param  OrderStatus  $status
     * @return void
     */
    public function __construct(OrderStatus $status)
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.status-badge');
    }
}
