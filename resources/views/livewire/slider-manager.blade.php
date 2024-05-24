<!-- resources/views/livewire/slider-manager.blade.php -->
<div>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
   
        <div class="flex items-center">
            <!-- Form to add a new slider -->
            <form wire:submit.prevent="addItem" enctype="multipart/form-data">
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
                    <x-label for="image_path">Image:</x-label>
                    <input type="file" id="image_path" wire:model.lazy="image_path">
                    @error('image_path') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-label for="seqNo">Sequence Number:</x-label>
                    <input type="number" id="seqNo" wire:model.lazy="seqNo" min="1">
                    @error('seqNo') <span class="error">{{ $message }}</span> @enderror
                </div>
                <x-secondary-button type="submit" class="ms-4 my-2">Add Slider</x-secondary-button>               

            </form>

        </div>
       <!-- Image preview -->
        @if ($image_path)
            <img src="{{ $image_path->temporaryUrl() }}" alt="Logo Preview" class="h-full w-full mx-2 my-2">
        @endif
    </div>
    <h2>Sliders</h2>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        
        <div class="flex items-center">
            <!-- Display the list of sliders -->
            <ul>
                @foreach ($sliders as $slider)
                    <li>
                        <strong>Title:</strong> {{ $slider->title }},
                        <strong>Description:</strong> {{ $slider->description }},
                        <strong>Image:</strong> <img src="{{ Storage::url($slider->image_path) }}" alt="{{ $slider->title }}" width="100" />,
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
                                            
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
    
