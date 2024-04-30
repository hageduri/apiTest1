<!-- resources/views/livewire/upload-logo.blade.php -->

<div class="max-w-7xl mx-auto flex">
    <div class="w-7/12">
        Images
    </div>
    <div class="4/12">
        <form class="mt-3 bg-white p-4 rounded-md" wire:submit.prevent="saveHeadLogo">
            <div class="mt-3">
                <label class="block mb-2 teext-sm font-medium text-gray-900 dark:text-white">Upload Image</label>
                <input wire:model="image"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer"
                    type="file">
                <div wire:loading wire:target="photo">Uploading...</div>
                @if($image)
                    <img class="w-18 h-18 rounded-md" src="{{ $image->temporaryUrl() }}">
                @endif
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>            

            @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                {{ session('message') }}
            </div>
            @endif

            @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ session('error') }}!</strong>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            @endif
            <div class="mt-3">
                <x-secondary-button type="submit" >Upload</x-secondary-button>
            </div>

            <h2>Uploaded Images</h2>
            @foreach ($images as $image)
                <div>
                    <img src="{{ asset( $image->path) }}" alt="Uploaded Image" style="max-width: 300px;">
                    <div>Image Name: {{ $image->name }}</div>
                    <button wire:click="delete({{ $image->id }})" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                </div>
            @endforeach

                <h2>Uploaded Images2</h2>
        <select wire:model="selectedImageId">
            <option value="">Select Image to Replace</option>
            @foreach ($images as $image)
                <option value="{{ $image->id }}">{{ $image->name }}</option>
            @endforeach
        </select>
        <button wire:click="update">Update Image</button>

        </form>
    </div>
</div>