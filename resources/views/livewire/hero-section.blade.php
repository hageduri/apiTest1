<div class="container">

    <!-- create-hero-section.blade.php -->
<form wire:submit="saveHeroSection">
    {{-- <div>
        <label for="title">Title:</label>
        <input type="text" wire:model="title" id="title" required>
        @error('title') <span>{{ $message }}</span> @enderror
    </div> --}}
    <div>
        <label for="description">Description:</label>
        <textarea wire:model="description" id="description"></textarea>
        @error('description') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="image_path">Image:</label>
        <input type="file" wire:model="image_path" id="image_path" required>
        @error('image_path') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="seqNo">Sequence:</label>
        <input type="number" wire:model="seqNo" id="seqNo" required>
        @error('seqNo') <span>{{ $message }}</span> @enderror
    </div>
    <button type="submit">Submit</button>
</form>


    {{-- <!-- You can add other content or elements here -->
    <div class="image-container">
      <img src="image1.jpg" alt="Image 1">
      <img src="image2.jpg" alt="Image 2">
      <img src="image3.jpg" alt="Image 3">
      <!-- Add more image tags as needed -->
    </div> --}}

    <h2 class="image-container">Uploaded Images</h2>
            @if ($slides)
            @foreach ($slides as $slide)
            <div>
                <img src="{{'storage/'.$slide->image_path}}" alt="Uploaded Image" style="max-width: 300px;">
                <div>Image Name: {{ $slide->title }}</div>
                <span class="mr-2">Sequence No. {{ $slide->seqNo }}</span>
                <div class="ml-4">
                    {{-- <h3 class="font-bold">{{ $slide->alt }}</h3> <!-- Display description --> --}}
                    <p>{{ $slide->description }}</p> <!-- Display description -->
                </div>
                
                {{-- <x-secondary-button wire:click="setUpdateImage({{ $image->id }})">Update</x-secondary-button>
                @if ($selectedImageId==$image->id)
                    <h2>Replace Image</h2>
                    <div>
                        <input type="file" wire:model="image">
                        <x-secondary-button wire:click="update({{ $selectedImageId }})">Replace Image</x-secondary-button>
                    </div>
                @endif

                <x-secondary-button wire:click="confirmDelete({{ $image->id }})">Delete</x-secondary-button>
                @if ($confirmingImageDeletion == $image->id)
                    <div>
                        Do you want to delete this image?
                        <x-secondary-button wire:click="delete({{ $image->id }})">Yes</x-secondary-button>
                        <x-secondary-button wire:click="$set('confirmingImageDeletion', null)">No</x-secondary-button>
                    </div>
                @endif --}}
            </div>
        @endforeach    
            @endif
</div>


