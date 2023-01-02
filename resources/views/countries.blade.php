<x-header></x-header>
<div class=" px-[10px] sm:px-[40px] pt-4 sm:pt-[40px] md:px-[108px] md:pt-10" >
    <h1 class="text-[#010414]  text-md  font-bold font-inter sm:text-[25px]">{{__('common.worldwide_statistic')}}</h1>
    <div class="pt-10 sm:pt-10 pb-[16px] border-b border-b-[#F6F6F7]">
        <a class="font-inter text-sm sm:text-md " href="{{route('show.home')}}">{{__('common.worldwilde')}}</a>
        <a class="{{request()->routeIs('show.countries')? 'font-inter text-sm sm:text-md ml-[72px] relative font-bold after:absolute after:w-[100%] after:h-[2px] after:bg-[#010414] after:left-0 after:bottom-[-16px] ' : ''}}" href="{{route('show.countries')}}">{{__('common.by_country')}}</a>
    </div>
    <div class="w-[239px] relative">
        <form >
            <input type="search" 
            placeholder="{{__('common.search')}}" 
            name="search"
            value="{{request('search')}}"
            class="placeholder:text-[11px] block w-full pl-8 appearance-none rounded-md border border-gray-300 px-3 py-2 mt-10 placeholder-gray-400 shadow-sm focus:border-[#0FBA68] focus:outline-none  sm:text-sm">
            <img class="absolute top-[10px] left-[10px]" src="images/search.svg" alt="search button">
        </form>
    </div>
    <div class="lg:py-10 ">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 mx-0 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-y-scroll h-[34vh] shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                <th scope="col"  class="flex items-center py-3.5 pl-1 pr-1 sm:pr-3 text-left text-[8px] sm:text-sm font-semibold text-gray-900 sm:pl-6">
                                    <div class="flex items-center min-w-[50px] text-[8px] sm:text-sm" >
                                        {{__('statistic.location')}}
                                       <div class="ml-[5px]">
                                        <a  href="{{route('show.countries', 'column=name&order='. $sortedAsc)}}">
                                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z" class="
                                                @if (request('column') === 'name' && request('order') === 'asc')  fill-black
                                                    
                                                @endif
                                                "  fill="#BFC0C4"/>
                                            </svg>
                                        </a>
                                        <a class="block mt-[2px]" href="{{route('show.countries', 'column=name&order='. $sortedDesc)}}">
                                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 5.5L0 0.5H10L5 5.5Z" class="@if (request('column') === 'name' && request('order') === 'desc')) fill-black
                                                    
                                                @endif" fill="#BFC0C4"/>
                                            </svg>
                                                
                                        </a>
                                       </div>
                                    </div>
                                </th>
                                <th scope="col" class="sm:px-3 py-3.5 text-left text-xs sm:text-sm  font-semibold text-gray-900">
                                    <div class="flex items-center min-w-[50px] text-[8px] sm:text-sm" >
                                        {{__('statistic.new_cases')}}
                                        <div class="ml-[5px]" >
                                            <a href="{{route('show.countries', 'column=new_cases&order='. $sortedAsc)}}">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z"  class="@if (request('column') === 'new_cases' && request('order') === 'asc')) fill-black
                                                        
                                                    @endif"  fill="#BFC0C4"/>
                                                </svg>
                                            </a>
                                            <a class="block mt-[2px]" href="{{route('show.countries', 'column=new_cases&order='. $sortedDesc)}}">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 5.5L0 0.5H10L5 5.5Z" class="@if (request('column') === 'new_cases' && request('order') === 'desc')) fill-black
                                                        
                                                    @endif" fill="#BFC0C4"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="sm:px-3 py-3.5 text-left text-xs sm:text-sm  font-semibold text-gray-900">
                                    <div class="flex items-center min-w-[50px] text-[8px] sm:text-sm"  >
                                        {{__('statistic.death')}}
                                        <div class="ml-[5px]">
                                            <a href="{{route('show.countries', 'column=deaths&order='. $sortedAsc)}}">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z" class="@if (request('column') === 'deaths' && request('order') === 'asc')) fill-black
                                                        
                                                    @endif" fill="#BFC0C4"/>
                                                </svg>
                                                
                                            </a>
                                            <a class="block mt-[2px]" href="{{route('show.countries', 'column=deaths&order='. $sortedDesc)}}">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 5.5L0 0.5H10L5 5.5Z" class="@if (request('column') === 'deaths' && request('order') === 'desc')) fill-black
                                                        
                                                    @endif" fill="#BFC0C4"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="sm:px-3 py-3.5 text-left text-xs sm:text-sm  font-semibold text-gray-900">
                                    <div class="flex items-center min-w-[50px] text-[8px] sm:text-sm"  >
                                        {{__('statistic.recovered')}}
                                       <div class="ml-[5px]">
                                        <a href="{{route('show.countries', 'column=recovered&order='. $sortedAsc)}}">
                                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z" class="@if (request('column') === 'recovered' && request('order') === 'asc')) fill-black
                                                        
                                                @endif"  fill="#BFC0C4"/>
                                            </svg>
                                            
                                        </a>
                                        <a class="block mt-[2px]" href="{{route('show.countries', 'column=recovered&order='. $sortedDesc)}}">
                                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 5.5L0 0.5H10L5 5.5Z" class="@if (request('column') === 'recovered' && request('order') === 'desc')) fill-black
                                                        
                                                @endif" fill="#BFC0C4"/>
                                            </svg>
                                        </a>
                                       </div>
                                    </div>
                                </th>
                                </tr>
                            </thead>
                           
                            <tbody class="divide-y divide-gray-200 bg-white">

                                <tr>
                                    <td class="py-4 pl-1 pr-0 sm:pr-3 text-[8px] sm:text-sm font-medium text-gray-900 sm:pl-6">{{__('statistic.Worldwide')}}</td>
                                    <td class="px-3 py-4 text-[8px] sm:text-sm text-gray-500">{{$new_cases}}</td>
                                    <td class="px-3 py-4 text-[8px] sm:text-sm text-gray-500">{{$deaths}}</td>
                                    <td class="px-3 py-4 text-[8px] sm:text-sm text-gray-500">{{$recovered}}</td>
                                </tr>

                                @foreach ( $countries as $country )
                                
                                <tr>
                                <td class="py-4 pl-1 pr-0 sm:pr-3 text-[8px] sm:text-sm font-medium text-gray-900 sm:pl-6">{{$country->name}}</td>
                                <td class="px-3 py-4 text-[8px] sm:text-sm text-gray-500">{{$country->new_cases}}</td>
                                <td class="px-3 py-4 text-[8px] sm:text-sm text-gray-500">{{$country->deaths}}</td>
                                <td class="px-3 py-4 text-[8px] sm:text-sm text-gray-500">{{$country->recovered}}</td>
                                </tr>

                                @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
  </div>
  
</div>