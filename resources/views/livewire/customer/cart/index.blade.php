<div class="bg-[#F3EDE8] min-h-screen">
    <div class="max-w-7xl max-lg:max-w-4xl mx-auto p-6">
        <h2 class="text-xl font-semibold text-slate-900">Your shopping cart</h2>

        <div x-data="{ show: false, type: 'success', message: '' }"
             x-on:cart-alert.window="show = true; type = $event.detail.type; message = $event.detail.message; setTimeout(() => show = false, 5000)"
             x-show="show"
             x-transition.duration.500ms
             class="mt-4 mb-4">
            
            <template x-if="type === 'success'">
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                        <div>
                            <p class="font-bold">Success</p>
                            <p class="text-sm" x-text="message"></p>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="type === 'error'">
                <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                        <div>
                            <p class="font-bold">Error</p>
                            <p class="text-sm" x-text="message"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        @if (empty($cart))
            <div class="mt-6 p-6 bg-white shadow-sm border border-gray-300 rounded-md text-center">
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="mb-4 rounded-full bg-teal-100 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-teal-600">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
                    <p class="text-gray-500 mb-8 max-w-sm">
                        Add items to your cart to checkout.
                    </p>
                    <a href="/shop" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none flex items-center">
                        Start Shopping
                    </a>
                </div>
            </div>
        @else
            <div class="grid lg:grid-cols-3 gap-4 relative mt-6">
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($cart as $productId => $item)
                        <div class="p-6 bg-white shadow-sm border border-gray-300 rounded-md relative">
                            <div class="flex items-center max-sm:flex-col gap-4 max-sm:gap-6">
                                <div class="w-32 sm:w-40 aspect-[3/4] shrink-0 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover" alt="{{ $item['title'] }}" />
                                </div>
                                <div class="sm:border-l sm:pl-4 sm:border-gray-300 w-full">
                                    <h3 class="text-base font-semibold text-slate-900">{{ $item['title'] }}</h3>
                                    
                                    @if(isset($item['description']))
                                        <p class="mt-2 text-sm text-slate-500 font-medium line-clamp-2">{{ $item['description'] }}</p>
                                    @endif

                                    <hr class="border-gray-300 my-4" />

                                    <div class="flex items-center justify-between flex-wrap gap-4">
                                        <div class="flex items-center gap-4">
                                            <h4 class="text-sm font-semibold text-slate-900">Qty:</h4>
                                            <button type="button" wire:click="updateQuantity('{{ $productId }}', {{ $item['quantity'] - 1 }})"
                                                class="flex items-center justify-center w-[18px] h-[18px] bg-teal-600 outline-none rounded-sm cursor-pointer hover:bg-teal-700 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-white" viewBox="0 0 124 124">
                                                    <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                                                </svg>
                                            </button>
                                            <span class="font-semibold text-base leading-[16px]">{{ $item['quantity'] }}</span>
                                            <button type="button" wire:click="updateQuantity('{{ $productId }}', {{ $item['quantity'] + 1 }})"
                                                class="flex items-center justify-center w-[18px] h-[18px] bg-teal-600 outline-none rounded-sm cursor-pointer hover:bg-teal-700 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-white" viewBox="0 0 42 42">
                                                    <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="flex items-center">
                                            <h4 class="text-base font-semibold text-slate-900">LKR {{ number_format($item['price'] * $item['quantity'], 2) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Remove Button Positioned Top Right -->
                            <button type="button" wire:click="removeFromCart('{{ $productId }}')" class="absolute top-4 right-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500" viewBox="0 0 320.591 320.591">
                                    <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z" data-original="#000000"></path>
                                    <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z" data-original="#000000"></path>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="bg-white h-max rounded-md p-6 shadow-sm border border-gray-300 sticky top-0">
                    <h3 class="text-base font-semibold text-slate-900">Order Summary</h3>
                    <ul class="text-slate-500 font-medium text-sm divide-y divide-gray-300 mt-4">
                        <li class="flex flex-wrap gap-4 py-3 font-semibold text-slate-900">Total <span class="ml-auto">LKR {{ number_format($total, 2) }}</span></li>
                    </ul>
                    <button type="button" wire:click="confirmOrder" class="mt-6 text-sm font-medium px-4 py-2.5 tracking-wide w-full bg-teal-600 hover:bg-teal-700 text-white rounded-md cursor-pointer">Proceed to Checkout</button>
                </div>
            </div>
        @endif
    </div>
</div>