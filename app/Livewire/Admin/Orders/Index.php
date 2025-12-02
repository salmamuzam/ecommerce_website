<?php

namespace App\Livewire\Admin\Orders;

use App\Mail\OrderApprovalMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Index extends Component
{
    // Approve order: Changes status from pending to approved and sends email
    public function approveOrder($orderId)
    {
        // Finding the order
        $order = Order::with(['user', 'product'])->find($orderId);

        // If the order exists, approve and send mail
        if ($order) {

            $order->update(['status' => \App\Enums\OrderStatus::APPROVED]);

            // Send the email to the user
            Mail::to($order->user->email)->send(new OrderApprovalMail($order));

            session()->flash('message', "Order #{$order->id} has been approved successfully, and the customer has been notified.");

        }
        // Order not found
        else {
            session()->flash('error', "Order #{$orderId} not found.");
        }
    }

    // Cancel order: Changes status to cancelled
    public function cancelOrder($orderId)
    {
        // Find order and cancel it
        $order = Order::find($orderId);

        // Update status to Cancelled
        $order->update(['status' => \App\Enums\OrderStatus::CANCELLED]);

        session()->flash('message', 'Order cancelled successfully!');
    }

    // Render the component view with latest orders
    public function render()
    {
        return view('livewire.admin.orders.index', ['orders' => Order::with('product', 'user')->get()])->layout('components.layouts.admin', ['title' => 'Manage Orders']);
    }
}
