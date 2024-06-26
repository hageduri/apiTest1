<div>


<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
   
    <div class="flex items-center">
            
        
        <!-- create-hero-section.blade.php -->
        <form wire:submit="saveHeroSection">
            <h2 class=""> Add New Slide </h2>
            <div>
                <label for="title">Title:</label>
                <input type="text" wire:model="title" id="title" required class="mt-2 border rounded p-2">
                @error('title') <span>{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea wire:model="description" id="description" class="mt-2 border rounded p-2"></textarea>
                @error('description') <span>{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="image_path">Image:</label>
                <input type="file" wire:model="image_path" id="image_path" required class="mt-2 border rounded p-2">
                @error('image_path') <span>{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="seqNo">Sequence:</label>
                <input type="number" wire:model="seqNo" id="seqNo" class="mt-2 border rounded p-2">
                @error('seqNo') <span>{{ $message }}</span> @enderror
            </div>
            <x-secondary-button type="submit" class="mt-2 border rounded p-2">Submit</x-secondary-button>

            
        </form>                
        <!-- Image preview -->
            @if ($image_path)
                <img src="{{ $image_path->temporaryUrl() }}" alt="slide Preview" class="w-80 h-44 ml-8">
            @endif
    </div>
</div>
<h2>Uploaded Images</h2>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        
    <div class="flex items-center">          
                  
        
        @if ($slides)
        
            @foreach ($slides as $slide)
                <div class="px-2">
                    <img src="{{'storage/'.$slide->image_path}}" alt="Uploaded Image" class="w-44 h-44" style="max-width: 300px;">
                    {{-- <div>Image Name: {{ $slide->title }}</div> --}}
                    <span class="mr-2">Slide  {{ $slide->seqNo }}</span>
                    <div class="ml-4">
                        <h3 class="font-bold">{{ $slide->title }}</h3> <!-- Display description -->
                        <p>{{ $slide->description }}</p> <!-- Display description -->
                </div>
                    
                    {{-- <x-secondary-button wire:click="setUpdateImage({{ $image->id }})">Update</x-secondary-button>
                    @if ($selectedImageId==$image->id)
                        <h2>Replace Image</h2>
                        <div>
                            <input type="file" wire:model="image">
                            <x-secondary-button wire:click="update({{ $selectedImageId }})">Replace Image</x-secondary-button>
                        </div>
                    @endif --}}
                    @if ($slide)
                        <x-secondary-button wire:click="confirmDelete({{ $slide->id }})">Delete</x-secondary-button>
                        @if ($confirmingslideDeletion == $slide->id)
                            <div>
                                Do you want to delete this image?
                                <x-secondary-button wire:click="delete({{ $slide->id }})">Yes</x-secondary-button>
                                <x-secondary-button wire:click="$set('confirmingslideDeletion', null)">No</x-secondary-button>
                            </div>
                        @endif    
                    @endif  
                    
                </div>
            @endforeach    
        @endif
    
    </div>

    </div>
</div>


</div>

