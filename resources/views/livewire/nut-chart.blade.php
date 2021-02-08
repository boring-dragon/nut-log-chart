<div class="container mx-auto space-y-4 p-4 sm:p-0">

    <form class="space-y-8 divide-y divide-gray-200" wire:submit.prevent="save">
        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
            <div>

                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                    <div class="flex flex-col justify-center items-center">
                        <label for="nut_log_file" class="block text-sm font-medium text-gray-600 sm:mt-px sm:pt-2 mb-2">
                            Json nutlog file
                        </label>
                        <div class="mt-2 sm:mt-0 sm:col-span-2">
                            <div
                                class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" wire:model="nutlog" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        JSON
                                    </p>
                                </div>
                                @error('nutlog') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>

    @if($highest)
    <div>
        <h3 class="text-xl leading-6 text-center font-medium text-gray-700">
            Statistics
            <br>
            <span class="text-sm text-gray-600">({{$title}})</span>
        </h3>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Highest Nutted by day
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{$highest["data"]}}
                    </dd>

                    <dd class="mt-1 text-sm font-semibold text-gray-700">
                        {{$highest["date"]}}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Average Nut
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{round($average,2)}}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Total Nut Logged
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{$sum}}
                    </dd>
                </div>
            </div>
        </dl>
    </div>
    @endif

    @if($highest)
    @include('partials.badges', [
    'average' => $average,
    'sum' => $sum,
    'highest' => $highest["data"]
    ])

    @endif

    @if($nut_per_day)
    <h3 class="text-gray-700 text-xl font-semibold mt-3 text-center">Nut per Day</h3>
    <div class="shadow rounded p-4 border bg-white mt-5" style="height: 32rem;">
        <livewire:livewire-area-chart key="{{ $nut_per_day->reactiveKey() }}" :area-chart-model="$nut_per_day" />
    </div>
    @endif

    @if($nut_per_month)
    <h3 class="text-gray-700 text-xl font-semibold mt-3 text-center">Nut per Month</h3>
    <div class="shadow rounded p-4 border bg-white mt-5" style="height: 32rem;">
        <livewire:livewire-column-chart key="{{ $nut_per_month->reactiveKey() }}"
            :column-chart-model="$nut_per_month" />
    </div>
    @endif


    @if($how_often_chart)
    <h3 class="text-gray-700 text-xl font-semibold mt-3 text-center">How often and How much</h3>
    <p class="text-sm font-medium text-gray-500 truncate text-center">Amount per day</p>
    <div class="shadow rounded p-4 border bg-white mt-5" style="height: 32rem;">
        <livewire:livewire-column-chart key="{{ $how_often_chart->reactiveKey() }}"
            :column-chart-model="$how_often_chart" />
    </div>
    @endif


    @if($sharelink)
    <div class="mt-2 flex flex-col items-center justify-center ">
        <span class="text-xl font-bold text-blue-500 ">Share with your friends💦</span>
        <p class="text-gray-700 text-sm mb-2">
            Copy the link below to share
        </p>
        <span class="text-gray-700">{{url("/?nut={$sharelink->id}")}}</span>
    </div>
    @endif
</div>