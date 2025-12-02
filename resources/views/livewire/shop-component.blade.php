<div class="w-full bg-[#F3EDE8] font-poppins">
    <div class="w-full max-w-[85rem] py-2 px-4 sm:px-6 lg:px-8 mx-auto">
      <section class="py-2">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
          
          <h1 class="text-2xl font-bold text-gray-900 mb-4 text-center">Shop Our Collection</h1>
          
          <!-- Top Filter Bar -->
          <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4 border-y border-black py-4">
            <!-- Left: Breadcrumb -->
            <div class="w-full md:w-auto">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li>
                            <a href="/" class="text-gray-500 hover:text-gray-700 font-medium">Home</a>
                        </li>
                        <li>
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </li>
                        <li>
                            <span class="text-gray-900 font-medium" aria-current="page">Shop</span>
                        </li>
                    </ol>
                </nav>
            </div>



            <!-- Right: Filters -->
            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto justify-end">
                <!-- Collection Dropdown -->
                <div x-data="{ open: false, selected: 'Collection' }" @click.outside="open = false" class="relative w-full md:w-auto text-left">
                    <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-lg bg-white px-3 py-2 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 tracking-wide">
                        <span x-text="selected"></span>
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-full md:w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1">
                            <a href="#" @click.prevent="$wire.set('selectedCategories', []); selected = 'Collection'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">All Collections</a>
                            @foreach($categories as $category)
                                <a href="#" @click.prevent="$wire.set('selectedCategories', [{{ $category->id }}]); selected = '{{ $category->name }}'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Price Dropdown -->
                <div x-data="{ open: false }" @click.outside="open = false" class="relative w-full md:w-auto text-left">
                    <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-lg bg-white px-3 py-2 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 tracking-wide">
                        Price
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-full sm:w-72 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none p-6">
                        
                        <!-- Inputs -->
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div class="relative w-full">
                                <label class="text-xs text-gray-500 absolute -top-2 left-2 bg-white px-1">From</label>
                                <input type="number" wire:model.live.debounce.500ms="min_price" class="w-full text-center rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm bg-white py-2" placeholder="Min">
                            </div>
                            <span class="text-gray-400">-</span>
                            <div class="relative w-full">
                                <label class="text-xs text-gray-500 absolute -top-2 left-2 bg-white px-1">To</label>
                                <input type="number" wire:model.live.debounce.500ms="max_price" class="w-full text-center rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm bg-white py-2" placeholder="Max">
                            </div>
                        </div>

                        <!-- Apply Button -->
                        <button @click="open = false" type="button" class="w-full rounded-lg border-none bg-teal-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-teal-700 focus:outline-none transition-colors">
                            Apply
                        </button>
                    </div>
                </div>

                <!-- Sort Dropdown -->
                <div x-data="{ open: false, selected: 'Popular' }" @click.outside="open = false" class="relative w-full md:w-auto text-left">
                    <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-lg bg-white px-3 py-2 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 tracking-wide">
                        <span x-text="selected"></span>
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-full md:w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1">
                            <a href="#" @click.prevent="$wire.set('orderBy', 'Popular'); selected = 'Popular'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Popular</a>
                            <a href="#" @click.prevent="$wire.set('orderBy', 'Price: Low to High'); selected = 'Price: Low to High'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Price: Low to High</a>
                            <a href="#" @click.prevent="$wire.set('orderBy', 'Price: High to Low'); selected = 'Price: High to Low'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Price: High to Low</a>
                        </div>
                    </div>
                </div>

                <!-- Clear Filters -->
                @if($min_price != 0 || $max_price != $db_max_price || !empty($selectedCategories) || $orderBy != 'Default Sorting')
                    <button wire:click="resetFilters" type="button" class="text-sm text-red-600 hover:text-red-800 font-medium underline decoration-1 underline-offset-2">
                        Clear All
                    </button>
                @endif
            </div>
          </div>

          <!-- Product Grid -->
          <div class="mt-8">
                <h2 class="text-xl sm:text-2xl font-semibold text-slate-900 mb-6 sm:mb-8">Our Collection</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                    @forelse ($products as $product)
                    <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-3 flex flex-col h-full">
                    <a href="{{ route('product.show', $product->id) }}" class="block flex-grow">
                        <div class="aspect-[3/4] rounded-lg relative overflow-hidden group">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        </div>

                        <div class="mt-4">
                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">{{ $product->title }}</h5>
                        <h6 class="text-sm sm:text-base text-red-700 font-bold mt-1">LKR {{ number_format($product->price, 2) }}</h6>
                        </div>
                        <p class="text-slate-600 text-[13px] mt-2 line-clamp-2">{{ $product->description }}</p>
                    </a>
                    <div class="flex items-center gap-2 mt-6">
                        <div
                        class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-lg cursor-pointer transition-colors" title="Wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                            <path
                            d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                            data-original="#000000"></path>
                        </svg>
                        </div>
                        <button type="button" wire:click="addToCart({{ $product->id }})" class="text-sm px-2 py-2 font-medium cursor-pointer w-full bg-teal-600 hover:bg-teal-700 text-white tracking-wide ml-auto outline-none border-none rounded-lg transition-colors">Add to cart</button>
                    </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                        <p class="mt-1 text-gray-500">Try adjusting your filters.</p>
                    </div>
                    @endforelse
                </div>
          </div>

          <!-- Load More -->
          <div class="mt-8 text-center">
            <p class="text-sm text-gray-900 font-medium mb-6 tracking-wider">
                1 - {{ $products->count() }} OF {{ $products->total() }} PRODUCTS
            </p>
            
            @if($products->hasMorePages())
                <button wire:click="loadMore" wire:loading.attr="disabled" class="bg-teal-600 text-white px-12 py-3 text-sm font-medium tracking-widest hover:bg-teal-700 transition-colors uppercase rounded-lg">
                    Load More
                </button>
            @endif
          </div>
        </div>
      </section>
    </div>
</div>