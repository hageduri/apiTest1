<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
   
            <div class="flex items-center">
                <!-- Form to add a new slider -->
                <form wire:submit.prevent="save">
    
                    <!-- Success message -->    
                     
                    {{-- <div class="font-italic"
                    x-data="{show: false}"
                    x-show.transition.opacity.out.duration.1500ms="show"
                    x-init="@this.on('saved', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
                    style="background-color: Aquamarine"> Notice Added. </div> --}}
                    @if ($file_path)

                        Photo Preview:

                        <img src="{{ $file_path->temporaryUrl() }}">

                    @endif

                   
                    <div>
                        <x-label for="file_path">File Path:<p>Max:10240 kb</p></x-label>
                        <input type="file" id="file_path" wire:model="file_path" > 
                        <x-label>@error('file_path') <span class="error" style="color: tomato">{{ $message }}</span> @enderror</x-label>
                    
                    </div>
                    
                    <x-secondary-button type="submit" class="ms-4 my-2">Add Notice</x-secondary-button>               
    
                </form>               
    
            </div>
           <!-- Image preview -->
            
    
            
        </div>
    </div>
</div>