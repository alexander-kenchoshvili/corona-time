<x-layout>
    <div class="flex flex-col items-center">
        <div class="pt-10" >
            <img src="images/logo.svg" alt="main logo">
        </div>
        <div class="flex flex-col items-center mt-[148px]">
            <h2 class="text-center font-bold mb-[56px]">{{__('authenticate.forgot_password')}}</h2>
            <form action="{{route('password.request')}}" method="POST">
            @csrf
            <x-form.input name='email' label="{{__('authenticate.email')}}" value='' type='email' placeholder="{{__('authenticate.email_placeholder')}}"/>
            @error('email')
            <p class="flex items-center text-red-500 text-xs mt-2">
                <img class="mr-2" src="images/error.svg" alt="error">
                {{$message}}
            </p>
            @enderror
            <button type="submit" class="flex w-full justify-center mt-14 rounded-md border font-inter border-transparent bg-[#0FBA68] py-2 px-4 text-sm font-medium text-white focus:outline-none">{{__('authenticate.forgot_password')}}</button>
            </form>
        </div>
        <x-languages.language></x-languages.language>
    </div>
</x-layout>