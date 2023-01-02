<x-layout>
    <header x-data="{show:false}" class=" px-[20px] sm:px-[40px] pt-[20px] sm:pt-[40px] md:px-[108px] md:py-[20px] border-b border-b-[#F6F6F7]">
        <div>
            <nav class="bg-white px:0 py:0 sm:px-4 sm:py-4  ">
                <div class="flex flex-row justify-between items-center mx-auto">
                    <a href="{{route('show.home')}}" class="flex items-center w-[146px] " >
                        <img src="images/logo.svg" alt="main logo">
                    </a>
                    <div class="flex flex-row items-center gap-2 md:gap-10">
                        <div x-data="{ show: false }" class="z-2   md:text-base" @click.away="open = false">
                            <button class="self-center flex items-center text-xs sm:text-sm"
                                @click ="show = !show">
                                {{App::currentLocale()==='en'? "English" : "ქართული" }}
                                <img  class='ml-4'src="images/arrow.svg" alt="arrow">

                            </button>
                            <div class="flex flex-col absolute text-center z-2 " x-show="show">
                                <a href="/change-locale/en" class="text-xs sm:text-sm ">
                                    {{__('common.english')}}
                                </a>
                                <a href="/change-locale/ka"class="text-xs sm:text-sm" >
                                    {{__('common.georgian')}}
                                </a>
                            </div>
                         
                        </div>
                        <button class="pl-4 md:hidden">
                            <img src="images/hamburger.svg" class="" @click="show=!show" alt="hamburger menu">
                        </button>
                        <div class=" hidden flex-row items-center md:flex ">
                            @auth
                            <span class=" text-sm font-bold font-Inter ">
                                {{auth()->user()->username}}
                            </span>
                            @endauth
                            <form method="GET" action="{{route('logout')}}">
                                @csrf
                                <button class="font-medium ml-6 sm:text-sm " type="submit">{{__('common.log_out')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <nav>
                <div x-show="show" @click="show=false" @click.away="show=false" class=" md:hidden text-center text-lg" style="display: none;">
                    <ul class="p-3  mx-3 rounded-lg bg-[#0FBA68] box-border mt-2 ">
                        <span class=" text-sm font-bold font-Inter ">
                            {{auth()->user()->username}}
                        </span>
                        <form class="flex justify-center" method="GET" action="{{route('logout')}}">
                            @csrf
                            <button class="font-medium p-2 text-sm  hover:bg-blue-200 rounded-lg block" type="submit">{{__('common.log_out')}}</button>
                        </form>
                    </ul>
                </div>
            </nav>
        </div>
        </div>
    
    </header>
</x-layout>