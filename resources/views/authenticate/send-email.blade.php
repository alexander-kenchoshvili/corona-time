<x-layout>
    <div class="flex flex-col items-center">
        <div class="pt-10">
            <img src="{{asset('images/logo.svg')}}" alt="main logo">
        </div>
        <div class="flex flex-col items-center mt-[148px]">
            <img src="{{asset('images/checked.svg')}}" alt="checked">
            <p class="mt-4">{{__('authenticate.confirmation_email')}}</p>
        </div>
    </div>
</x-layout>