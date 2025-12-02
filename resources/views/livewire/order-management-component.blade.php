<div>
    <section class="p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <x-alert-success :message="session('message')" />
            <div class="relative overflow-hidden">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex-1 flex items-center space-x-2">
                        <h5>
                            <span class="text-gray-500">All Orders:</span>
                            <span class="text-gray-900">{{ $orders->count() }}</span>
                        </h5>
                    </div>
                </div>
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-transparent">
                            <tr>
                                <th scope="col" class="p-4 text-center">Order ID</th>
                                <th scope="col" class="p-4 text-center">Product</th>
                                <th scope="col" class="p-4 text-center">Quantity</th>
                                <th scope="col" class="p-4 text-center">Price Per Item</th>
                                <th scope="col" class="p-4 text-center">Total Price</th>
                                <th scope="col" class="p-4 text-center">User</th>
                                <th scope="col" class="p-4 text-center">Status</th>
                                <th scope="col" class="p-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-center align-middle">
                                {{ $order->id }}
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center align-middle">
                                {{ $order->product->title }}
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
                                {{ $order->quantity }}
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
                                ${{ number_format($order->price_per_item, 2) }}
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
                                ${{ number_format($order->total_price, 2) }}
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
                                {{ $order->user->name }}
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
                                <span class="{{ $order->status === 'approved' ? 'bg-green-100 text-green-800' : ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center align-middle">
                                <div class="flex items-center justify-center space-x-2">
                                    <button wire:click="approveOrder({{ $order->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 md:mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <span class="hidden md:inline">Approve</span>
                                    </button>
                                    <button wire:click="cancelOrder({{ $order->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-300 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 md:mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                        <span class="hidden md:inline">Cancel</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 text-gray-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                        No orders found
                                    </h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="block md:hidden mx-4">
                    @forelse ($orders as $order)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4 overflow-hidden">
                            <div class="p-4 flex flex-col space-y-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->id }}</h3>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <span class="{{ $order->status === 'approved' ? 'bg-green-100 text-green-800' : ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} text-xs font-medium px-2.5 py-0.5 rounded">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                                <div class="border-t border-gray-100 pt-3">
                                    <p class="text-sm text-gray-900"><span class="font-medium">Product:</span> {{ $order->product->title }}</p>
                                    <p class="text-sm text-gray-900"><span class="font-medium">User:</span> {{ $order->user->name }}</p>
                                    <p class="text-sm text-gray-900"><span class="font-medium">Quantity:</span> {{ $order->quantity }}</p>
                                    <p class="text-sm font-bold text-gray-900 mt-2">Total: ${{ number_format($order->total_price, 2) }}</p>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="bg-gray-50 px-4 py-3 flex justify-end space-x-3 border-t border-gray-100">
                                <button wire:click="approveOrder({{ $order->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Approve
                                </button>
                                <button wire:click="cancelOrder({{ $order->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-300 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-6 bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="bg-gray-100 rounded-full p-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No orders found</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>