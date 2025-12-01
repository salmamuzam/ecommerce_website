<?php

namespace App\Livewire;

use Livewire\Component;

class OrderManagementComponent extends Component
{
    public function render()
    {
        return view('livewire.order-management-component')->layout('components.layouts.admin', [
            'title' => 'Manage Orders',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>',
            'header_color' => 'text-teal-600'
        ]);
    }
}
