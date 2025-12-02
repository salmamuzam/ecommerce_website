<section class="py-8 bg-[#F3EDE8] md:py-16 antialiased font-poppins">
    <x-success-modal message="Product has been added to your cart." title="Successfully accepted!" />
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16 items-center">
            <div class="shrink-0 w-full max-w-[18rem] sm:max-w-sm mx-auto aspect-[3/4] rounded-lg relative overflow-hidden">
                <img class="w-full h-full object-cover rounded-lg" src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->title }}" />
            </div>

            <div class="mt-6 sm:mt-8 lg:mt-0 w-full max-w-[18rem] sm:max-w-sm mx-auto lg:max-w-none lg:mx-0">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
                        {{ $product->title }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-xl font-extrabold text-red-900 sm:text-2xl">
                            LKR {{ number_format($product->price, 2) }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex gap-4 items-center sm:mt-8">
                    <button type="button"
                        class="flex-1 flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-black sm:-ms-2 sm:me-2"
                            viewBox="0 0 64 64">
                            <path
                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                data-original="#000000"></path>
                        </svg>
                        <span class="hidden sm:inline">Add to favorites</span>
                    </button>

                    <button wire:click="addToCart({{ $product->id }})" type="button"
                        class="flex-1 text-white sm:mt-0 bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none flex items-center justify-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 sm:-ms-2 sm:me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <span class="hidden sm:inline">Add to cart</span>
                    </button>
                </div>

                <div class="mt-6">
                    <hr class="my-6 md:my-8 border-black" />

                    <p class="mb-6 text-gray-500 text-justify">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>