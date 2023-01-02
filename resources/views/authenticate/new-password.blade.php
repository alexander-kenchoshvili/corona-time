<x-layout>
    <div class="flex flex-col items-center">
        <div class="pt-10">
            <img src="{{asset('images/logo.svg')}}" alt="main logo">
        </div>
        <div class="flex flex-col items-center mt-[104px]">
            <h2 class="text-center font-inter font-bold mb-[56px]">{{__('authenticate.password_recover')}}</h2>
            <form method="POST" action="{{route('password.update')}}">
                @csrf 
                <input type="hidden" name="email" value="{{$email}}"  >
                <input type="hidden" name="token"  value="{{$token}}"  >
                <x-form.input name='password' label='' type='password' value='' placeholder="{{__('authenticate.enter_new_password')}}" />
                @error('password')
                <p class="flex items-center text-red-500 text-xs mt-2">
                    
                    {{$message}}
                </p>
                @enderror
                <x-form.input name='password_confirmation' label='' value='' type='password' placeholder="{{__('authenticate.repeat_password')}}" />
                @error('password_confirmation')
                <p class="flex items-center text-red-500 text-xs mt-2">
                  
                    {{$message}}
                </p>
                @enderror
                <button type="submit" class="flex w-full justify-center mt-14 rounded-md border font-inter border-transparent bg-[#0FBA68] py-2 px-4 text-sm font-medium text-white focus:outline-none">{{__('authenticate.save_changes')}}</button>
            </form>
        </div>
        <x-languages.language></x-languages.language>
    </div>
</x-layout>