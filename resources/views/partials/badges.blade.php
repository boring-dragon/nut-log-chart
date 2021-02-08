<div class="pt-12 sm:pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-gray-700 sm:text-4xl">
                Badges
            </h2>
            <p class="mt-3 text-xl text-gray-500 sm:mt-4">
                Badges <span class="text-blue-600 underline">{{$title}}</span> achieved during his/her nut journey
            </p>
        </div>
    </div>
    <div class="mt-10 pb-12 bg-white sm:pb-16">
        <div class="relative">
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                        @if($sum >= 150)
                        <div
                            class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                Nut Legend
                            </dt>
                            <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                <img class="h-16 w-16" src="/badges/legend.svg">
                            </dd>
                        </div>

                        @elseif($sum <= 100 && $sum>= 50)
                            <div
                                class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                    Nut Silver
                                </dt>
                                <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                    <img class="h-16 w-16" src="/badges/legend-silver.svg">
                                </dd>
                            </div>

                            @else
                            <div
                                class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                    Nut Noob
                                </dt>
                                <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                    <img class="h-16 w-16" src="/badges/legend-bronze.svg">
                                </dd>
                            </div>
                            @endif


                            @if($average > 2)
                            <div
                                class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                    Banana Plat
                                </dt>
                                <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                    <img class="h-16 w-16" src="/badges/banana-plat.svg">
                                </dd>
                            </div>

                            @elseif($average < 2) <div
                                class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                    Potato Plat
                                </dt>
                                <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                    <img class="h-16 w-16" src="/badges/potato-plat.svg">
                                </dd>
                </div>

                @else
                <div
                    class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                        Orange Plat
                    </dt>
                    <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                        <img class="h-16 w-16" src="/badges/orange-plat.svg">
                    </dd>
                </div>
                @endif

                @if($highest >= 8)
                <div
                    class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                        Eternal flame
                    </dt>
                    <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                        <img class="h-16 w-16" src="/badges/flame.svg">
                    </dd>
                </div>

                @elseif($highest < 8 && $highest> 3)
                    <div
                        class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                        <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                            Aqua
                        </dt>
                        <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                            <img class="h-16 w-16" src="/badges/water.svg">
                        </dd>
                    </div>

                    @else
                    <div
                        class="flex flex-col items-center border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                        <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                            Puff
                        </dt>
                        <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                            <img class="h-16 w-16" src="/badges/wind.svg">
                        </dd>
                    </div>
                    @endif


                    </dl>
            </div>
        </div>
    </div>
</div>
</div>