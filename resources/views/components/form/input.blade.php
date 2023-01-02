@props(['label','name','type','placeholder','value'])
<div>
    <label for="{{$name}}" class="block text-xs sm:text-sm font-medium text-gray-700">{{$label}}</label>
    <div class="relative mt-1">
    <input
        id="{{$name}}"
        name="{{$name}}" 
        type="{{$type}}"
        value="{{$value}}"
        placeholder="{{$placeholder}}"  
        class="placeholder:text-[11px] block w-full pl-8 appearance-none rounded-md border  px-3 py-2 my:0 sm:my-4 placeholder-gray-400 shadow-sm focus:border-[#2029F3] focus:outline-none sm:text-sm
        @if (!$errors->any())
          border-gray-300
        @elseif($errors->has($name))
            border-red-500
        @else
            border-green-500
        @endif
            ">
        <img  src="{{asset('images/valid.svg')}}" alt="valid" 
            class="absolute top-[8px] right-[10px]
            @if (!$errors->any() || $errors->has($name))
                hidden
            @else
                block
            @endif"
        >
    </div>
</div>

