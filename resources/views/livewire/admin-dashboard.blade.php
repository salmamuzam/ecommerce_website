<div class="px-3 sm:px-5">
    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
        <div class="px-4 mt-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <a href="{{ route('admin.orders') }}" class="flex items-center bg-white border rounded-sm overflow-hidden shadow hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-4 bg-pink-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-12 w-12 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Orders</h3>
                        <p class="text-3xl">{{ $totalOrders }}</p>
                    </div>
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center bg-white border rounded-sm overflow-hidden shadow hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-4 bg-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-12 w-12 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Products</h3>
                        <p class="text-3xl">{{ $totalProducts }}</p>
                    </div>
                </a>
                <a href="{{ route('admin.categories') }}" class="flex items-center bg-white border rounded-sm overflow-hidden shadow hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-4 bg-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-12 w-12 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                    </div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Categories</h3>
                        <p class="text-3xl">{{ $totalCategories }}</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="px-4 mt-8 mb-8">
            <div class="bg-white border rounded-sm shadow overflow-hidden">
                <div class="p-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                </div>
                
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <x-table>
                        <x-table.head>
                            <x-table.row>
                                <x-table.heading>Order ID</x-table.heading>
                                <x-table.heading>Product</x-table.heading>
                                <x-table.heading>Quantity</x-table.heading>
                                <x-table.heading>Price</x-table.heading>
                                <x-table.heading>Total</x-table.heading>
                                <x-table.heading>User</x-table.heading>
                                <x-table.heading>Status</x-table.heading>
                                <x-table.heading>Date</x-table.heading>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            @forelse ($recentOrders as $order)
                                <x-table.row>
                                    <x-table.cell class="font-medium text-gray-900">#{{ $order->id }}</x-table.cell>
                                    <x-table.cell>{{ $order->product->title }}</x-table.cell>
                                    <x-table.cell>{{ $order->quantity }}</x-table.cell>
                                    <x-table.cell>LKR {{ number_format($order->price_per_item, 2) }}</x-table.cell>
                                    <x-table.cell>LKR {{ number_format($order->total_price, 2) }}</x-table.cell>
                                    <x-table.cell>{{ $order->user->name }}</x-table.cell>
                                    <x-table.cell>
                                        <x-status-badge :status="$order->status" />
                                    </x-table.cell>
                                    <x-table.cell>{{ $order->created_at->format('M d, Y') }}</x-table.cell>
                                </x-table.row>
                            @empty
                                <x-table.row>
                                    <x-table.cell colspan="8" class="px-4 py-8 text-center text-gray-500">
                                        No recent orders found.
                                    </x-table.cell>
                                </x-table.row>
                            @endforelse
                        </x-table.body>
                    </x-table>
                </div>

                <!-- Mobile Card View -->
                <div class="block md:hidden bg-gray-50 p-4">
                    @forelse ($recentOrders as $order)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4 p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900">Order #{{ $order->id }}</h4>
                                    <p class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                                <x-status-badge :status="$order->status" />
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm text-gray-700"><span class="font-medium">Product:</span> {{ $order->product->title }}</p>
                                <p class="text-sm text-gray-700"><span class="font-medium">User:</span> {{ $order->user->name }}</p>
                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-sm text-gray-700"><span class="font-medium">Qty:</span> {{ $order->quantity }}</p>
                                    <p class="text-sm font-bold text-gray-900">LKR {{ number_format($order->total_price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            No recent orders found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>