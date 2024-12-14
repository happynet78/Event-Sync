<div>
    <div class="px-2 py-1 flex w-full">
        <div class="w-4/6 font-bold">
            <h2 class="text-2xl">{{ $date->format('F Y') }}</h2>
        </div>

        <div wire:click="previousMonth()" class="w-1/6 text-right hover:text-gray-900 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-right">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </div>

        <div wire:click="nextMonth()" class="w-1/6 text-right hover:text-gray-900 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 float-right">
                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <div class="flex flex-wrap text-xs text-center transition border-gray-600 border-2" wire:loading.class="opacity-20">

        <div class="flex w-full py-2">
            <div class="border-2 bg-gray-100 border-b-teal-500 text-center font-bold py-2 text-lg" style="width: 14.28%">월</div>
            <div class="border-2 bg-gray-100 border-b-teal-500 text-center font-bold py-2 text-lg" style="width: 14.28%">화</div>
            <div class="border-2 bg-gray-100 border-b-teal-500 text-center font-bold py-2 text-lg" style="width: 14.28%">수</div>
            <div class="border-2 bg-gray-100 border-b-teal-500 text-center font-bold py-2 text-lg" style="width: 14.28%">목</div>
            <div class="border-2 bg-gray-100 border-b-teal-500 text-center font-bold py-2 text-lg" style="width: 14.28%">금</div>
            <div class="border-2 bg-gray-100 border-b-teal-500 text-center font-bold py-2 text-blue-600 text-lg" style="width: 14.28%">토</div>
            <div class="border-2 bg-gray-100 border-b-teal-500 text-center font-bold py-2 text-red-600 text-lg" style="width: 14.28%">일</div>
        </div>

        @php
            $startdate = $date->clone()->startOfMonth()->startOfWeek()->subDay();
            $enddate = $date->clone()->endOfMonth()->endOfWeek()->subDay();
            $loopdate = $startdate->clone();
            $month = $date->clone();
        @endphp

        @while ($loopdate < $enddate)
            <div style="width:14.28%" class="grid grid-flow-row auto-rows-max hover:auto-rows-min text-lg h-32 hover:font-bold border-solid border
            @if($loopdate < $month->startOfMonth() || $loopdate > $month->endOfMonth()) opacity-50 bg-gray-200 border-inherit @endif
            @if($loopdate->dayOfWeek == 5) text-blue-600 @elseif($loopdate->dayOfWeek == 6) text-red-600 @endif
            ">
                {{ $loopdate->format('j') }}
            </div>
            @php($loopdate->addDay())
        @endwhile

    </div>
</div>
