<x-header></x-header>
<div class=" px-[10px] pt-4 sm:px-[40px] sm:pt-[40px] md:px-[108px] md:pt-10" >
    <h1 class="text-[#010414] text-md font-bold font-inter sm:text-[25px]">{{__('common.worldwide_statistic')}}</h1>
    <div class="pt-10 pb-[16px] border-b border-b-[#F6F6F7]">
        <a class="{{request()->routeIs('show.home')? 'font-inter text-sm sm:text-md relative font-bold after:absolute after:w-[100%] after:h-[2px] after:bg-[#010414] after:left-0 after:bottom-[-16px] ' : ''}}" href="{{route('show.home')}}">{{__('common.worldwilde')}}</a>
        <a class="font-inter ml-[72px] text-sm sm:text-md  "  href="{{route('show.countries')}}">{{__('common.by_country')}}</a>
    </div>
    <div class="pt-10  grid grid-cols-2 sm:grid-cols-3 sm:gap-10 gap-5  ">
        <div class=" col-span-2  md:col-span-1    py-10 bg-[rgba(32,41,243,0.08)]   rounded-2xl shadow-[1px_2px_8px_rgba(0,0,0,0.4)]">
            <div class="flex  flex-col items-center">
                <img src="images/chart1.svg" alt="new cases chart">
                <h2 class="font-inter text-xs md:text-xl mt-6 font-medium">{{__('statistic.new_cases')}}</h2>
                <span class="text-[#2029F3] mt-4 font-bold font-inter text-xs sm:text-sm md:text-[39px]">{{number_format($countries->pluck('new_cases')->sum(),0,',')}}</span>
            </div>
        </div>
        <div class="py-10 bg-[rgba(15,186,104,0.08)]    rounded-2xl shadow-[1px_2px_8px_rgba(0,0,0,0.4)]">
            <div class="flex  flex-col items-center">
                <img src="images/chart2.svg" alt="new cases chart">
                <h2 class="font-inter text-xs md:text-xl mt-6 font-medium">{{__('statistic.recovered')}}</h2>
                <span class="text-[#0FBA68] mt-4 font-bold font-inter text-xs md:text-[39px]">{{number_format($countries->pluck('recovered')->sum(),0,',')}}</span>
            </div>
        </div>
        <div class="py-10 bg-[rgba(234,214,33,0.08)]   rounded-2xl shadow-[1px_2px_8px_rgba(0,0,0,0.4)]">
            <div class="flex  flex-col items-center">
                <img src="images/chart3.svg" alt="new cases chart">
                <h2 class="font-inter text-xs md:text-xl mt-6 font-medium">{{__('statistic.death')}}</h2>
                <span class="text-[#EAD621] mt-4 font-bold font-inter text-xs md:text-[39px]">{{number_format($countries->pluck('deaths')->sum(),0,',')}}</span>
            </div>
        </div>
    </div>
</div>
