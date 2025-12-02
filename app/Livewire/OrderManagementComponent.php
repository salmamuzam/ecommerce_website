<?php

namespace App\Livewire;

use App\Mail\OrderApprovalMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OrderManagementComponent extends Component
{
    // Approve order button
    // Changes from pending to approved

    public function approveOrder($orderId)
    {

        // Finding the order
        $order = Order::with(['user', 'product'])->find($orderId);

        // If the order exists, approve the mail
        if ($order) {

            $order->update(['status' => 'approved']);

            // Send the email to the user

            Mail::to($order->user->email)->send(new OrderApprovalMail($order));

            session()->flash('message', "Order #{$order->id} has been approved successfully, and the customer has been notified.");

        }
        // Order not found
        else {

            session()->flash('error', "Order #{$orderId} not found.");

        }

    }

    // Cancel order
    public function cancelOrder($orderId)
    {
        //   Find order and cancel it
        $order = Order::find($orderId);

        // Pending or Approved to Cancelled
        $order->update(['status' => 'cancelled']);

        session()->flash('message', 'Order cancelled successfully!');

    }

    public function render()
    {
        // Return the view

        return view('livewire.order-management-component', ['orders' => Order::with('product', 'user')->get()])->layout('components.layouts.admin', ['title' => 'Manage Orders']);

    }
}
