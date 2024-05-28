<!-- resources/views/livewire/slider-manager.blade.php -->
<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
   
            <div class="flex items-center">
                <!-- Form to add a new slider -->
                <form wire:submit.prevent="addItem" enctype="multipart/form-data">
    
                    <!-- Success message -->    
                     
                    <div class="font-italic"
                    x-data="{show: false}"
                    x-show.transition.opacity.out.duration.1500ms="show"
                    x-init="@this.on('saved', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
                    style="background-color: Aquamarine"> Slide Added. </div>
                    

                    <div>
                        <x-label for="title">Title:</x-label>
                        <input type="text" id="title" wire:model.lazy="title">
                        @error('title') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-label for="description">Description:</x-label>
                        <input type="text" id="description" wire:model.lazy="description">
                        @error('description') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-label for="image_path">Image:<p>(width=1400,height=437)pixels </p></x-label>
                        <input type="file" id="image_path" wire:model.lazy="image_path">
                        <x-label>@error('image_path') <span class="error" style="color: tomato">{{ $message }}</span> @enderror</x-label>
                        
                    </div>
                    <div>
                        <x-label for="seqNo">Sequence Number:</x-label>
                        <input type="number" id="seqNo" wire:model.lazy="seqNo" min="1">
                        {{-- @error('seqNo') <span class="error">{{ $message }}</span> @enderror --}}
                        <x-label>@error('seqNo') <span class="error" style="color: tomato">{{ $message }}</span> @enderror</x-label>
                    </div>
                    <x-secondary-button type="submit" class="ms-4 my-2">Add Slider</x-secondary-button>               
    
                </form>                      
    
            </div>
           <!-- Image preview -->
            @if ($image_path)
                <img src="{{ $image_path->temporaryUrl() }}" alt="Logo Preview" class="h-full w-full mx-2 my-2">
            @endif
    
            
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            
            <div class="flex items-center">
                <!-- Display the list of sliders -->
                <ul>
                    
                    <!-- Delete message -->    
                    <div class="font-italic"
                    x-data="{show: false}"
                    x-show.transition.opacity.out.duration.1500ms="show"
                    x-init="@this.on('deleted', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
                    style="display: none; background-color: tomato"> 
                    Logo Deleted.</div>
    
                     <!-- Success message -->    
                     <div class="font-italic"
                     x-data="{show: false}"
                     x-show.transition.opacity.out.duration.1500ms="show"
                     x-init="@this.on('SeqNum', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
                     style="display: none; background-color: gold"> Sequence No Updated. </div>
    
                    @foreach ($sliders as $slider)
                        <li>
                            <strong>Title:</strong> {{ $slider->title }}
                            <strong>Description:</strong> {{ $slider->description }} <br>
                            <strong>Image:</strong> <img src="{{ Storage::url($slider->image_path) }}" alt="{{ $slider->title }}" width="100" />
                            
    
                            <strong>SeqNo:</strong> 
                            @if (isset($editSeqNo[$slider->id]))
                                <input type="number" wire:model.lazy="editSeqNo.{{ $slider->id }}">
                                <x-secondary-button wire:click="saveSeqNo({{ $slider->id }})">Save</x-secondary-button>
                                <!-- Cancel button to clear preview and hide the preview mode -->
                                @if ("editSeqNo.{{ $slider->id }}")
                                <x-button type="button" class="bg-yellow-500 text-white px-4 py-2 rounded ml-2"
                                wire:click="clearSeq">
                                    Cancel
                                </x-button>    
                            @endif
                            @else
                                {{ $slider->seqNo }}
                                <x-secondary-button wire:click="editSeqNo1({{ $slider->id }})" class="ms-4 my-2">Edit</x-secondary-button>
                            @endif
                            <x-secondary-button wire:click="deleteItem({{ $slider->id }})" class="ms-4 my-2"
                                wire:confirm="Are you sure you want to delete this slide?"
                                >Delete</x-secondary-button>              
                        </li> <br>
                    @endforeach
    
                </ul>
            </div>
        </div>
    </div>
    
     

</div>
    
