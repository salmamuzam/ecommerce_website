<div>
    <section class="p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <x-alert-success :message="session('message')" />
            <div class="relative">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex-1 flex items-center space-x-2">
                        <h5>
                            <span class="text-gray-500">All Products:</span>
                            <span class="text-gray-900">{{ $products->total() }}</span>
                        </h5>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                                <input type="text" wire:model.live="search" id="simple-search" placeholder="Search for products" required="" class="bg-transparent border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full pl-10 p-2">
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0 relative">
                        <button type="button" wire:click="create" class="flex items-center justify-center text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2 border border-transparent focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Add product
                        </button>
                        <div class="relative w-full md:w-auto">
                            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                </svg>
                                Filter options
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="filterDropdown" class="absolute z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-full md:w-80 right-0 max-h-96 overflow-y-auto" wire:ignore.self>
                                <div class="flex items-center justify-between pt-2">
                                    <h6 class="text-sm font-medium text-black">Filters</h6>
                                    <div class="flex items-center space-x-3">
                                        <button class="flex items-center text-sm font-medium text-teal-600 hover:underline">Save view</button>
                                        <button wire:click="resetFilters" class="flex items-center text-sm font-medium text-teal-600 hover:underline">Clear all</button>
                                    </div>
                                </div>
                                <div id="accordion-flush" data-accordion="collapse" data-active-classes="text-black" data-inactive-classes="text-gray-500">
                                    <!-- Category -->
                                    <h2 id="category-heading">
                                        <button type="button" class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-50" data-accordion-target="#category-body" aria-expanded="true" aria-controls="category-body">
                                            <span>Category</span>
                                            <svg aria-hidden="true" data-accordion-icon="" class="w-5 h-5 rotate-180 shrink-0" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                            </svg>
                                        </button>
                                    </h2>
                                    <div id="category-body" class="hidden" aria-labelledby="category-heading">
                                        <div class="py-2 font-light border-b border-gray-200">
                                            <ul class="space-y-2">
                                                @foreach($categories as $category)
                                                    <li class="flex items-center">
                                                        <input id="category-{{ $category->id }}" type="checkbox" value="{{ $category->id }}" wire:model.live="selectedCategories" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-teal-600 focus:ring-teal-500 focus:ring-2">
                                                        <label for="category-{{ $category->id }}" class="ml-2 text-sm font-medium text-gray-900">{{ $category->name }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Price -->
                                    <h2 id="price-heading">
                                        <button type="button" class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-50" data-accordion-target="#price-body" aria-expanded="true" aria-controls="price-body">
                                            <span>Price (LKR)</span>
                                            <svg aria-hidden="true" data-accordion-icon="" class="w-5 h-5 rotate-180 shrink-0" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                            </svg>
                                        </button>
                                    </h2>
                                    <div id="price-body" class="hidden" aria-labelledby="price-heading">
                                        <div class="flex items-center py-2 space-x-3 font-light border-b border-gray-200">
                                            <input type="number" wire:model.live.debounce.500ms="priceFrom" placeholder="From" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5">
                                            <input type="number" wire:model.live.debounce.500ms="priceTo" placeholder="To" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 w-full md:w-auto relative">
                            <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                                Actions
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="actionsDropdown" class="absolute right-0 hidden z-10 w-full md:w-44 bg-white rounded divide-y divide-gray-100 shadow" wire:ignore.self>

                                <div class="py-1">
                                    <button wire:click="deleteSelected" class="block w-full text-left py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete All</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-transparent whitespace-nowrap">
                            <tr>
                                <th scope="col" class="p-4 text-center">
                                    <div class="flex items-center justify-center">
                                        <input id="checkbox-all" type="checkbox" wire:model.live="selectAll" class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 focus:ring-2">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="p-4 text-center">Image</th>
                                <th scope="col" class="p-4 text-center">Title</th>
                                <th scope="col" class="p-4 text-center">Description</th>
                                <th scope="col" class="p-4 text-center">Category</th>
                                <th scope="col" class="p-4 text-center">Price (LKR)</th>
                                <th scope="col" class="p-4 text-center">Popular</th>
                                <th scope="col" class="p-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4 w-4 text-center align-middle">
                                        <div class="flex items-center justify-center">
                                            <input id="checkbox-table-search-{{ $product->id }}" type="checkbox" value="{{ $product->id }}" wire:model.live="selectedProducts" class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 focus:ring-2">
                                            <label for="checkbox-table-search-{{ $product->id }}" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center align-middle">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="h-10 w-auto rounded mx-auto">
                                        @else
                                            <div class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center text-gray-500 mx-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center align-middle">
                                        {{ $product->title }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 text-center align-middle">
                                        {{ Str::limit($product->description, 50) }}
                                    </td>
                                    <td class="px-4 py-3 text-center align-middle">
                                        @php
                                            $categoryName = strtolower($product->category->name ?? '');
                                            $badgeClass = 'bg-gray-100 text-gray-800'; // Default
                                            if (str_contains($categoryName, 'abaya')) {
                                                $badgeClass = 'bg-pink-100 text-pink-800';
                                            } elseif (str_contains($categoryName, 'hijab')) {
                                                $badgeClass = 'bg-purple-100 text-purple-800';
                                            } elseif (str_contains($categoryName, 'accessory') || str_contains($categoryName, 'accessories')) {
                                                $badgeClass = 'bg-blue-100 text-blue-800';
                                            } elseif (str_contains($categoryName, 'dress')) {
                                                $badgeClass = 'bg-red-100 text-red-800';
                                            }
                                        @endphp
                                        <span class="{{ $badgeClass }} text-xs font-medium px-2 py-0.5 rounded">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center align-middle">
                                        {{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center align-middle">
                                        {{ $product->is_popular ? 'Yes' : 'No' }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center align-middle">
                                        <div class="flex items-center justify-center space-x-4">
                                            <button wire:click="edit({{ $product->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 md:mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                Edit
                                            </button>
                                            <button wire:click="show({{ $product->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 md:mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                <span class="hidden md:inline">Preview</span>
                                            </button>
                                            <button wire:click="deleteId({{ $product->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-300 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 md:mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                            <button type="button" wire:click="create" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                Add Product
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="block md:hidden mx-4">
                    @forelse($products as $product)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4 overflow-hidden">
                            <div class="p-4 flex flex-col items-center space-y-2 text-center">
                                <!-- Image -->
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="h-20 w-20 rounded object-cover mb-2">
                                @else
                                    <div class="h-20 w-20 rounded bg-gray-200 flex items-center justify-center text-gray-500 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>
                                @endif

                                <!-- Title -->
                                <h3 class="text-lg font-semibold text-gray-900">{{ $product->title }}</h3>

                                <!-- Category -->
                                @php
                                    $categoryName = strtolower($product->category->name ?? '');
                                    $badgeClass = 'bg-gray-100 text-gray-800'; // Default
                                    if (str_contains($categoryName, 'abaya')) {
                                        $badgeClass = 'bg-pink-100 text-pink-800';
                                    } elseif (str_contains($categoryName, 'hijab')) {
                                        $badgeClass = 'bg-purple-100 text-purple-800';
                                    } elseif (str_contains($categoryName, 'accessory') || str_contains($categoryName, 'accessories')) {
                                        $badgeClass = 'bg-blue-100 text-blue-800';
                                    } elseif (str_contains($categoryName, 'dress')) {
                                        $badgeClass = 'bg-red-100 text-red-800';
                                    }
                                @endphp
                                <span class="{{ $badgeClass }} px-2.5 py-0.5 rounded-full text-xs font-medium">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>

                                <!-- Price -->
                                <p class="text-sm font-bold text-gray-900">LKR {{ number_format($product->price, 2) }}</p>

                                <!-- Popular -->
                                <p class="text-sm text-gray-500">
                                    Popular: <span class="font-medium text-gray-900">{{ $product->is_popular ? 'Yes' : 'No' }}</span>
                                </p>

                                <!-- Description -->
                                <p class="text-sm text-gray-500 line-clamp-2 max-w-xs">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="bg-gray-50 px-4 py-3 flex justify-center space-x-6 border-t border-gray-100">
                                <button wire:click="edit({{ $product->id }})" class="text-blue-600 hover:text-blue-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="show({{ $product->id }})" class="text-gray-600 hover:text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button wire:click="deleteId({{ $product->id }})" class="text-red-600 hover:text-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-6 bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="bg-gray-100 rounded-full p-4 mb-4">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No products found</h3>
                            <p class="text-gray-500 text-sm">Try adjusting your search or filter.</p>
                        </div>
                    @endforelse
                </div>
                <div class="p-4 border-t border-gray-200">
                    {{ $products->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </section>

    <!-- Create Product Modal -->
    <div id="createProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" wire:ignore.self>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create New Product
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="createProductModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="p-4 md:p-5" wire:submit.prevent="saveProduct">
                    <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
                        <div class="col-span-1 sm:col-span-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" wire:model="title" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" required="">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price (LKR)</label>
                            <input type="number" wire:model="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" required="">
                            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
<div x-data="{ open: false, selected: @entangle('category_id'), categories: {{ $categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->values()->toJson() }} }">
                                <div class="relative">
                                    <button type="button" @click="open = !open" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 text-left flex justify-between items-center">
                                        <span x-text="selected ? (categories.find(c => c.id == selected)?.name || 'Select category') : 'Select category'"></span>
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 w-full bg-white rounded-lg shadow-lg border border-gray-200 mt-1 max-h-60 overflow-y-auto" style="display: none;">
                                        <template x-for="category in categories" :key="category.id">
                                            <div @click="selected = category.id; open = false" class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-sm text-gray-700" x-text="category.name"></div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                             <label class="block mb-2 text-sm font-medium text-gray-900">Mark as Popular</label>
                             <label class="relative inline-flex items-center cursor-pointer w-full h-[42px]">
                                <input type="checkbox" value="" class="sr-only peer" wire:model="is_popular">
                                <div class="w-full h-full bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-lg peer peer-checked:bg-teal-600 transition-colors duration-300"></div>
                                <div class="absolute top-1 left-1 bg-white border-gray-300 border rounded-md h-[calc(100%-8px)] w-[calc(50%-4px)] transition-transform duration-300 peer-checked:translate-x-full shadow-sm"></div>
                            </label>
                        </div>
                        <div class="col-span-1 sm:col-span-3">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <textarea id="description" wire:model="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500" placeholder="Write product description here"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1 sm:col-span-3">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Product Image</label>
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10">
                                <div class="text-center">
                                    @if ($image && !$errors->has('image'))
                                        <img src="{{ $image->temporaryUrl() }}" class="mx-auto h-32 object-cover rounded-lg mb-4">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-gray-300">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    @endif
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600 justify-center">
                                        <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-teal-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-teal-600 focus-within:ring-offset-2 hover:text-teal-500">
                                            <span>{{ $image ? 'Change file' : 'Upload a file' }}</span>
                                            <input id="image" type="file" wire:model.live="image" class="sr-only" accept="image/png, image/jpeg, image/webp">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, WebP up to 1MB</p>
                                </div>
                            </div>
                            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white inline-flex items-center justify-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Add new product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" wire:ignore.self>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Edit Product
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="editProductModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="p-4 md:p-5" wire:submit.prevent="updateProduct">
                    <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-3">
                        <div class="col-span-1 sm:col-span-3">
                            <label for="edit_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" wire:model="title" id="edit_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" required="">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="edit_price" class="block mb-2 text-sm font-medium text-gray-900">Price (LKR)</label>
                            <input type="number" wire:model="price" id="edit_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" required="">
                            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="edit_category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
<div x-data="{ open: false, selected: @entangle('category_id'), categories: {{ $categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->values()->toJson() }} }">
                                <div class="relative">
                                    <button type="button" @click="open = !open" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 text-left flex justify-between items-center">
                                        <span x-text="selected ? (categories.find(c => c.id == selected)?.name || 'Select category') : 'Select category'"></span>
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 w-full bg-white rounded-lg shadow-lg border border-gray-200 mt-1 max-h-60 overflow-y-auto" style="display: none;">
                                        <template x-for="category in categories" :key="category.id">
                                            <div @click="selected = category.id; open = false" class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-sm text-gray-700" x-text="category.name"></div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                             <label class="block mb-2 text-sm font-medium text-gray-900">Mark as Popular</label>
                             <label class="relative inline-flex items-center cursor-pointer w-full h-[42px]">
                                <input type="checkbox" value="" class="sr-only peer" wire:model="is_popular">
                                <div class="w-full h-full bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-lg peer peer-checked:bg-teal-600 transition-colors duration-300"></div>
                                <div class="absolute top-1 left-1 bg-white border-gray-300 border rounded-md h-[calc(100%-8px)] w-[calc(50%-4px)] transition-transform duration-300 peer-checked:translate-x-full shadow-sm"></div>
                            </label>
                        </div>
                        <div class="col-span-1 sm:col-span-3">
                            <label for="edit_description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <textarea id="edit_description" wire:model="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1 sm:col-span-3">
                            <label for="new_image" class="block mb-2 text-sm font-medium text-gray-900">Product Image</label>
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10">
                                <div class="text-center">
                                    @if ($new_image && !$errors->has('new_image'))
                                        <img src="{{ $new_image->temporaryUrl() }}" class="mx-auto h-32 object-cover rounded-lg mb-4">
                                    @elseif($old_image)
                                        <img src="{{ asset('storage/' . $old_image) }}" class="mx-auto h-32 object-cover rounded-lg mb-4">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-gray-300">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    @endif
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600 justify-center">
                                        <label for="new_image" class="relative cursor-pointer rounded-md bg-white font-semibold text-teal-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-teal-600 focus-within:ring-offset-2 hover:text-teal-500">
                                            <span>{{ $new_image ? 'Change file' : 'Upload a file' }}</span>
                                            <input id="new_image" type="file" wire:model.live="new_image" class="sr-only" accept="image/png, image/jpeg, image/webp">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, WebP up to 1MB</p>
                                </div>
                            </div>
                            @error('new_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button type="submit" class="text-white w-full inline-flex justify-center items-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 012 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                        Update product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div id="deleteProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" wire:ignore.self>
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="deleteProductModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto mb-4 text-black w-12 h-12">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this product?</h3>
                    <button wire:click="deleteProduct" data-modal-hide="deleteProductModal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="deleteProductModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Product Modal -->
    <div id="viewProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" wire:ignore.self>
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Product Details
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="viewProductModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <div class="mb-4 text-center">
                        @if($view_image)
                            <img src="{{ asset('storage/' . $view_image) }}" alt="{{ $view_title }}" class="mx-auto h-48 object-cover rounded-lg">
                        @else
                            <div class="h-48 w-full bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <div class="sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                {{ $view_title }}
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                {{ $view_category }}
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                LKR {{ number_format($view_price, 2) }}
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Popular</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                {{ $view_popular ? 'Yes' : 'No' }}
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 min-h-[100px]">
                                {{ $view_description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            const modalOptions = {
                backdrop: 'dynamic',
                backdropClasses: 'bg-gray-900/50 fixed inset-0 z-40',
                closable: true,
            };

            const createModal = new Modal(document.getElementById('createProductModal'), modalOptions);
            const editModal = new Modal(document.getElementById('editProductModal'), modalOptions);
            const deleteModal = new Modal(document.getElementById('deleteProductModal'), modalOptions);
            const viewModal = new Modal(document.getElementById('viewProductModal'), modalOptions); // Initialize viewModal

            Livewire.on('close-modal', () => {
                createModal.hide();
                editModal.hide();
                deleteModal.hide();
                viewModal.hide(); // Hide view modal on close-modal
            });

            Livewire.on('open-create-modal', () => {
                createModal.show();
            });

            Livewire.on('open-edit-modal', () => {
                editModal.show();
            });

            Livewire.on('open-delete-modal', () => {
                deleteModal.show();
            });

            Livewire.on('open-view-modal', () => { // Listener for opening view modal
                viewModal.show();
            });
        });
    </script>
    @endscript
</div>
```
