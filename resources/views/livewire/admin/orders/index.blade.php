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
                    <x-table>
                        <x-table.head>
                            <x-table.row>
                                <x-table.heading>Order ID</x-table.heading>
                                <x-table.heading>Product</x-table.heading>
                                <x-table.heading>Quantity</x-table.heading>
                                <x-table.heading>Price Per Item</x-table.heading>
                                <x-table.heading>Total Price</x-table.heading>
                                <x-table.heading>User</x-table.heading>
                                <x-table.heading>Status</x-table.heading>
                                <x-table.heading>Actions</x-table.heading>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                    @forelse ($orders as $order)
                        <x-table.row>
                            <x-table.cell>
                                {{ $order->id }}
                            </x-table.cell>
                            <x-table.cell class="font-medium text-gray-900 whitespace-nowrap">
                                {{ $order->product->title }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $order->quantity }}
                            </x-table.cell>
                            <x-table.cell>
                                ${{ number_format($order->price_per_item, 2) }}
                            </x-table.cell>
                            <x-table.cell>
                                ${{ number_format($order->total_price, 2) }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $order->user->name }}
                            </x-table.cell>
                            <x-table.cell>
                                <x-status-badge :status="$order->status" />
                            </x-table.cell>
                            <x-table.cell class="font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <button wire:click="approveOrder({{ $order->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 focus:outline-none">
                                        <x-icon.check class="size-4 md:mr-2" />
                                        <span class="hidden md:inline">Approve</span>
                                    </button>
                                    <button wire:click="cancelOrder({{ $order->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-300 focus:outline-none">
                                        <x-icon.x-mark class="size-4 md:mr-2" />
                                        <span class="hidden md:inline">Cancel</span>
                                    </button>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="8" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 text-gray-900">
                                        <x-icon.clock class="w-16 h-16" />
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                        No orders found
                                    </h3>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                        </x-table.body>
                    </x-table>
                </div>

                <!-- Mobile Card View -->
                <div class="block md:hidden mx-4">
                    @forelse ($orders as $order)
                        <x-card>
                            <x-card.body class="flex flex-col space-y-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->id }}</h3>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <x-status-badge :status="$order->status" />
                                </div>

                                <div class="border-t border-gray-100 pt-3">
                                    <p class="text-sm text-gray-900"><span class="font-medium">Product:</span> {{ $order->product->title }}</p>
                                    <p class="text-sm text-gray-900"><span class="font-medium">User:</span> {{ $order->user->name }}</p>
                                    <p class="text-sm text-gray-900"><span class="font-medium">Quantity:</span> {{ $order->quantity }}</p>
                                    <p class="text-sm font-bold text-gray-900 mt-2">Total: ${{ number_format($order->total_price, 2) }}</p>
                                </div>
                            </x-card.body>

                            <!-- Actions -->
                            <x-card.footer class="flex justify-end space-x-3">
                                <button wire:click="approveOrder({{ $order->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 focus:outline-none">
                                    <x-icon.check class="size-4 mr-2" />
                                    Approve
                                </button>
                                <button wire:click="cancelOrder({{ $order->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-300 focus:outline-none">
                                    <x-icon.x-mark class="size-4 mr-2" />
                                    Cancel
                                </button>
                            </x-card.footer>
                        </x-card>
                    @empty
                        <div class="flex flex-col items-center justify-center py-6 bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="bg-gray-100 rounded-full p-4 mb-4">
                                <x-icon.clock class="w-8 h-8 text-gray-500" />
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No orders found</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>