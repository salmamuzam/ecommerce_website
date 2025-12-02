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
                                    <x-icon.search class="size-6" />
                                </div>
                                <input type="text" wire:model.live="search" id="simple-search" placeholder="Search for products" required="" class="bg-transparent border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full pl-10 p-2">
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0 relative">
                        <button type="button" wire:click="create" class="flex items-center justify-center text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2 border border-transparent focus:outline-none">
                            <x-icon.plus class="size-6 mr-2" />
                            Add product
                        </button>
                        <div class="relative w-full md:w-auto">
                            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                                <x-icon.filter class="size-6 mr-2" />
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
                                            <x-icon.chevron-down class="w-5 h-5 rotate-180 shrink-0" />
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
                                            <x-icon.chevron-down class="w-5 h-5 rotate-180 shrink-0" />
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
                                <x-icon.chevron-down class="-mr-1 ml-1.5 w-5 h-5" />
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
                    <x-table>
                        <x-table.head>
                            <x-table.row>
                                <x-table.heading>
                                    <div class="flex items-center justify-center">
                                        <input id="checkbox-all" type="checkbox" wire:model.live="selectAll" class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 focus:ring-2">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </x-table.heading>
                                <x-table.heading>Image</x-table.heading>
                                <x-table.heading>Title</x-table.heading>
                                <x-table.heading>Description</x-table.heading>
                                <x-table.heading>Category</x-table.heading>
                                <x-table.heading>Price (LKR)</x-table.heading>
                                <x-table.heading>Popular</x-table.heading>
                                <x-table.heading>Actions</x-table.heading>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            @forelse($products as $product)
                                <x-table.row>
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
                                                <x-icon.photo class="size-6" />
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
                                            <x-icon.pencil class="size-4 md:mr-2" />
                                                Edit
                                            </button>
                                            <button wire:click="show({{ $product->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 focus:outline-none">
                                            <x-icon.eye class="size-4 md:mr-2" />
                                                <span class="hidden md:inline">Preview</span>
                                            </button>
                                            <button wire:click="deleteId({{ $product->id }})" class="flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-300 focus:outline-none">
                                            <x-icon.trash class="size-4 md:mr-2" />
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </x-table.row>
                            @empty
                                <tr>
                                            <button type="button" wire:click="create" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none flex items-center">
                                                <x-icon.plus class="size-6 mr-2" />
                                                Add Product
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </x-table.body>
                    </x-table>
                </div>

                <!-- Mobile Card View -->
                <div class="block md:hidden mx-4">
                    @forelse($products as $product)
                        <x-card>
                            <x-card.body class="flex flex-col items-center space-y-2 text-center">
                                <!-- Image -->
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="h-20 w-20 rounded object-cover mb-2">
                                @else
                                    <div class="h-20 w-20 rounded bg-gray-200 flex items-center justify-center text-gray-500 mb-2">
                                        <x-icon.photo class="size-8" />
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
                            </x-card.body>

                            <!-- Actions -->
                            <x-card.footer class="flex justify-center space-x-6">
                                <button wire:click="edit({{ $product->id }})" class="text-blue-600 hover:text-blue-900">
                                    <x-icon.pencil class="size-6" />
                                </button>
                                <button wire:click="show({{ $product->id }})" class="text-gray-600 hover:text-gray-900">
                                    <x-icon.eye class="size-6" />
                                </button>
                                <button wire:click="deleteId({{ $product->id }})" class="text-red-600 hover:text-red-900">
                                    <x-icon.trash class="size-6" />
                                </button>
                            </x-card.footer>
                        </x-card>
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
    <x-custom-modal wire:model.live="isCreateModalOpen" maxWidth="md">
        <x-slot name="title">
            Create New Product
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="saveProduct">
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                    <div class="col-span-1 sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <x-input type="text" wire:model="form.title" id="name" class="block w-full" required />
                        <x-input-error for="form.title" class="mt-2" />
                    </div>
                    <div class="col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price (LKR)</label>
                        <x-input type="number" wire:model="form.price" id="price" class="block w-full" required />
                        <x-input-error for="form.price" class="mt-2" />
                    </div>
                    <div class="col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                        <x-select wire:model="form.category_id" :options="$categories->pluck('name', 'id')" placeholder="Select category" />
                        <x-input-error for="form.category_id" class="mt-2" />
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                         <label class="block mb-2 text-sm font-medium text-gray-900">Mark as Popular</label>
                         <label class="relative inline-flex items-center cursor-pointer w-full h-[42px]">
                            <input type="checkbox" value="" class="sr-only peer" wire:model="form.is_popular">
                            <div class="w-full h-full bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-lg peer peer-checked:bg-teal-600 transition-colors duration-300"></div>
                            <div class="absolute top-1 left-1 bg-white border-gray-300 border rounded-md h-[calc(100%-8px)] w-[calc(50%-4px)] transition-transform duration-300 peer-checked:translate-x-full shadow-sm"></div>
                        </label>
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <x-textarea id="description" wire:model="form.description" rows="4" placeholder="Write product description here" />
                        <x-input-error for="form.description" class="mt-2" />
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                        <x-file-input model="form.image" label="Product Image" :preview="$form->image ? $form->image->temporaryUrl() : null" />
                    </div>
                </div>
                <button type="submit" class="w-full text-white inline-flex items-center justify-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <x-icon.plus class="size-6 mr-2" />
                    Add new product
                </button>
            </form>
        </x-slot>
    </x-custom-modal>

    <!-- Edit Product Modal -->
    <x-custom-modal wire:model.live="isEditModalOpen" maxWidth="md">
        <x-slot name="title">
            Edit Product
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="updateProduct">
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                    <div class="col-span-1 sm:col-span-2">
                        <label for="edit_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <x-input type="text" wire:model="form.title" id="edit_name" class="block w-full" required />
                        <x-input-error for="form.title" class="mt-2" />
                    </div>
                    <div class="col-span-1">
                        <label for="edit_price" class="block mb-2 text-sm font-medium text-gray-900">Price (LKR)</label>
                        <x-input type="number" wire:model="form.price" id="edit_price" class="block w-full" required />
                        <x-input-error for="form.price" class="mt-2" />
                    </div>
                    <div class="col-span-1">
                        <label for="edit_category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                        <x-select wire:model="form.category_id" :options="$categories->pluck('name', 'id')" placeholder="Select category" />
                        <x-input-error for="form.category_id" class="mt-2" />
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                         <label class="block mb-2 text-sm font-medium text-gray-900">Mark as Popular</label>
                         <label class="relative inline-flex items-center cursor-pointer w-full h-[42px]">
                            <input type="checkbox" value="" class="sr-only peer" wire:model="form.is_popular">
                            <div class="w-full h-full bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-lg peer peer-checked:bg-teal-600 transition-colors duration-300"></div>
                            <div class="absolute top-1 left-1 bg-white border-gray-300 border rounded-md h-[calc(100%-8px)] w-[calc(50%-4px)] transition-transform duration-300 peer-checked:translate-x-full shadow-sm"></div>
                        </label>
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                        <label for="edit_description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <x-textarea id="edit_description" wire:model="form.description" rows="4" />
                        <x-input-error for="form.description" class="mt-2" />
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                        <x-file-input model="form.new_image" label="Product Image" :preview="$form->new_image ? $form->new_image->temporaryUrl() : ($form->old_image ? asset('storage/' . $form->old_image) : null)" />
                    </div>
                </div>
                <button type="submit" class="text-white w-full inline-flex justify-center items-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <x-icon.pencil class="me-1 -ms-1 w-5 h-5" />
                    Update product
                </button>
            </form>
        </x-slot>
    </x-custom-modal>

    <!-- Delete Product Modal -->
    <x-custom-confirmation-modal wire:model.live="confirmingProductDeletion" maxWidth="md">
        <x-slot name="content">
            <x-icon.exclamation-circle class="mx-auto mb-4 text-black w-12 h-12" />
            <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this product?</h3>
            <button wire:click="deleteProduct" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                Yes, I'm sure
            </button>
            <button @click="show = false" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancel</button>
        </x-slot>
    </x-custom-confirmation-modal>

    <!-- Mass Delete Product Modal -->
    <x-custom-confirmation-modal wire:model.live="confirmingMultipleProductDeletion" maxWidth="md">
        <x-slot name="content">
            <x-icon.exclamation-circle class="mx-auto mb-4 text-black w-12 h-12" />
            <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete the selected products?</h3>
            <button wire:click="confirmDeleteSelected" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                Yes, delete all
            </button>
            <button @click="show = false" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancel</button>
        </x-slot>
    </x-custom-confirmation-modal>

    <!-- Preview Product Modal -->
    <x-custom-modal wire:model.live="isPreviewModalOpen" maxWidth="md">
        <x-slot name="title">
            Product Details
        </x-slot>

        <x-slot name="content">
            <div class="mb-4 text-center">
                @if($viewingProduct && $viewingProduct->image)
                    <img src="{{ asset('storage/' . $viewingProduct->image) }}" alt="{{ $viewingProduct->title }}" class="mx-auto h-48 object-cover rounded-lg">
                @else
                    <div class="h-48 w-full bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                        <x-icon.photo class="size-12" />
                    </div>
                @endif
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                    <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        {{ $viewingProduct->title ?? '' }}
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                    <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        {{ $viewingProduct->category->name ?? 'Uncategorized' }}
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                    <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        LKR {{ number_format($viewingProduct->price ?? 0, 2) }}
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Popular</label>
                    <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        {{ ($viewingProduct->is_popular ?? false) ? 'Yes' : 'No' }}
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 min-h-[100px]">
                        {{ $viewingProduct->description ?? '' }}
                    </div>
                </div>
            </div>
        </x-slot>
    </x-custom-modal></div>
