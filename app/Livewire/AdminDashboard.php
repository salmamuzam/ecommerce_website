<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $totalOrders;
    public $totalProducts;
    public $totalCategories;
    public $recentOrders;

    public function mount()
    {
        $this->loadOverviewData();
    }

    public function loadOverviewData()
    {
        $this->totalOrders = Order::count();
        $this->totalProducts = Product::count();
        $this->totalCategories = Category::count();
        $this->recentOrders = Order::with('user', 'product')->latest()->take(8)->get();
    }
    public function render()
    {
        return view('livewire.admin-dashboard')->layout('components.layouts.admin', ['title' => 'Admin Dashboard']);
    }
}
