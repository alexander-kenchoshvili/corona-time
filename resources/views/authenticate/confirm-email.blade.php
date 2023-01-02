<x-layout>
    <div class="flex flex-col items-center">
        <div>
            <img src="images/logo.svg" alt="main logo">
        </div>
        <div class="flex flex-col items-center mt-[148px]">
            <img src="images/checked.svg" alt="checked">
            <p class="mt-4 font-inter">Your account is confirmed, you can sign in</p>
            <a href="{{route('show.sign-in')}}" class="flex w-full  justify-center font-inter rounded-md border border-transparent bg-[#0FBA68] py-2 px-4 text-sm font-medium text-white mt-14 focus:outline-none">SIGN IN</a>
        </div>
    </div>
</x-layout>