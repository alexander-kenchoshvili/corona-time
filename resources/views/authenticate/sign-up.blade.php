<x-layout>
    <div class="flex sm:min-h-full">
        <div class="flex flex-1 flex-col w-2/3  py-10 px-4 sm:pl-[108px] lg:flex-none ">
            <div class=" w-full max-w-sm lg:w-96">
                <div>
                    <img class="h-12 w-auto" src="images/logo.svg" alt="main logo">
                    <h2 class="mt-6 text:xl sm:text-2xl font-bold tracking-tight text-gray-900">{{__('authenticate.welcome_to_coronatime')}}</h2>
                    <p class="mt-2 text-xs sm:text-sm text-gray-600 font-inter">
                        {{__('authenticate.please_enter_required_info')}}
                    </p>
                </div>
                <div class="mt-6">
                    <form action="/register" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-1">
                            <x-form.input label="{{__('authenticate.username')}}" name="username" value="{{old('username')}}" type="text" placeholder="{{__('authenticate.user_placeholder')}}" />
                            <p class="text-xs text-gray-400 font-inter ">{{__('authenticate.user_warning_message')}}</p>
                            @error('username')
                                <p class="flex items-center text-red-500 text-xs mt-2">
                                    <img class="mr-2" src="images/error.svg" alt="error">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="space-y-1">
                            <x-form.input label="{{__('authenticate.email')}}" name='email' value="{{old('email')}}" type="email" placeholder="{{__('authenticate.email_placeholder')}}" />
                            @error('email')
                            <p class="flex items-center text-red-500 text-xs mt-2">
                                <img class="mr-2" src="images/error.svg" alt="error">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="space-y-1">
                            <x-form.input label="{{__('authenticate.password')}}" name="password" value="{{old('passwprd')}}" type="password" placeholder="{{__('authenticate.password_placeholder')}}"/>
                            @error('password')
                            <p class="flex items-center text-red-500 text-xs mt-2">
                                <img class="mr-2" src="images/error.svg" alt="error">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="space-y-1">
                            <x-form.input  label="{{__('authenticate.repeat_password')}}" name="password_confirmation" value="{{old('password_confirmation')}}" type="password" placeholder="{{__('authenticate.repeat_password')}}"/>
                            @error('password_confirmation')
                            <p class="flex items-center text-red-500 text-xs mt-2">
                                <img class="mr-2" src="images/error.svg" alt="error">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-[#0FBA68] py-2 px-4 text-sm font-medium text-white focus:outline-none">{{__('authenticate.sign_up')}}</button>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">{{__('authenticate.already_have_an_account?')}}<a class="text-black" href="{{route('login')}}"> {{__('authenticate.login')}}</a></p>
                        </div>
                    </form>
                </div>
                <x-languages.language></x-languages.language>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="images/vaccine.png" alt="vaccine">
        </div>
    </div>
</x-layout>