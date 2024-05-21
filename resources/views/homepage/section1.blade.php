{{-- container --}}
<div class=" text-white font-bold max-w-[1280px] w-full flex justify-between items-center">
    {{-- left logo and department name--}}
    <div class="flex items-center">
        <div>
            <img class="h-[100px] p-2" src="logos/pngegg.png" height="100" alt="">
        </div>
        <div class="text-black block">
            <p class="font-medium">Department of XYZ</p>
            <p class=" font-bold text-2xl">Government of Arunachal</p>
        </div>
    </div>
    {{-- right logo / having two or can be more which have one fix logo for digital india and other editable--}}
    <div class="flex items-center">
        <div id="db_logo1" >
            @if ($imagePath)
                @if ($logok)
                    <a href="{{ $logok }}">
                        <img src="{{ $imagePath }}" alt="Logo" class="object-fit h-24 mx-2 my-2">
                    </a>
                    @else 
                        <a href="#">
                            <img src="{{ $imagePath }}" alt="Logo" class="object-fit h-24 mx-2 my-2">
                        </a>
                @endif
                
            @else
                <div class="bg-gray-200 rounded-full h-24 w-24 mx-2 my-2 flex items-center justify-center text-gray-400">
                    No Logo
                </div>
            @endif
            {{-- <img src="" alt=""> --}}
        </div>
        <div id="db_logo2" class="hidden">
            {{-- will be used by admin --}}
            <img src="" alt="">
        </div>
        <div>
            <img src="logos/digitalindia.png" alt="">
        </div>
    </div>
</div>
