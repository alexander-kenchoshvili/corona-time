<x-layout>
    <div class="flex sm:min-h-full">
        <div class="flex flex-1 flex-col w-2/3  py-10 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class=" w-full max-w-sm lg:w-96">
                <div>
                    <img class="h-12 w-auto" src="images/logo.svg" alt="main logo">
                    <h2 class="mt-[60px] text-1xl font-bold tracking-tight text-gray-900 font-inter ">{{__('authenticate.welcome_back')}}</h2>
                    <p class="mt-2 text-sm text-gray-600 font-inter">
                       {{__('authenticate.enter_details')}}
                    </p>
                </div>
                <div class="mt-6">
                    <form action="/login" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-1">
                            <x-form.input label="{{__('authenticate.username_or_email')}}" value="{{old('username')}}" name="username" type="text" placeholder="{{__('authenticate.username_or_email_placeholder')}}" />
                            @error('username')
                                <p class="flex items-center text-red-500 text-xs mt-2">
                                    <img class="mr-2" src="images/error.svg" alt="error">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="space-y-1">
                            <x-form.input label="{{__('authenticate.password')}}" name="password" value="{{old('password')}}" type="password" placeholder="{{__('authenticate.password_placeholder')}}"/>
                            @error('password')
                                <p class="flex items-center text-red-500 text-xs mt-2">
                                    <img class="mr-2" src="images/error.svg" alt="error">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" name='remember' value="1">
                                <label class="ml-2 font-inter text-sm " for="checkbox">{{__('authenticate.remember')}}</label>
                            </div>
                            <a class="font-inter text-sm" href="{{route('password.request')}}">{{__('authenticate.forgot_password')}}</a>
                            
                        </div>
                        <div>
                            <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-[#0FBA68] py-2 px-4 text-sm font-medium text-white focus:outline-none">{{__('authenticate.login')}}</button>
                        </div>
                        <div class="flex justify-center">
                            <p class="text-sm text-gray-400 font-inter">{{__('authenticate.dont_have_an_account?')}}<a class="text-black font-inter" href="{{route('show.register')}}"> {{__('authenticate.sign_up')}}</a></p>
                        </div>
                    </form>
                </div>
                <x-languages.language></x-languages.language>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="images/vaccine.png" alt="">
        </div>
    </div>
</x-layout>