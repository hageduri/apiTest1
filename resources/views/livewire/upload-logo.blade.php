<div>
    <!-- Display the current image if it exists -->
        @if ($imagePath)
            <img src="{{ $imagePath }}" alt="Logo" class="rounded-full h-24 w-24 mx-2 my-2">
        @else
            <div class="bg-gray-200 rounded-full h-24 w-24 mx-2 my-2 flex items-center justify-center text-gray-400">
                No Logo
            </div>
    @endif

    <!-- Form to upload a new image -->
    <form>
        <input type="file" wire:model="logo" class="mx-2 my-2">
        @error('logo') <span class="error">{{ $message }}</span> @enderror

        <input type="text" wire:model="logoL" placeholder="Enter logo link" class="mt-2 border rounded p-2">
        @error('logoL') <span class="error">{{ $message }}</span> @enderror

        <x-button class=" bg-blue-500 mx-2 my-2"
        type="button"
        wire:click="save"
        wire:confirm="Are you sure you want to save this image?"
        wire:loading.attr="disabled"
    >
        Save
    </x-button>

    <!-- Cancel button to clear preview and hide the preview mode -->
    @if ($logo || $logoL)
        <x-button type="button" class="bg-yellow-500 text-white px-4 py-2 rounded ml-2"
        wire:click="clearLogo">
            Cancel
        </x-button>    
    @endif

    <!-- Delete button, shown only if there's an existing logo -->
        @if ($imagePath && !$logo)
            <x-button class="bg-red-500 mx-2 my-2"
                type="button"
                wire:click="delete"
                wire:confirm="Are you sure you want to delete this logo?"            
            >
                Delete
            </x-button>
        @endif

        <!-- Image preview -->
        @if ($logo)
            <img src="{{ $logo->temporaryUrl() }}" alt="Logo Preview" class="rounded-full h-24 w-24 mx-2 my-2">
        @endif
        
    </form>
    
    


    <!-- Success message -->    
    <div class="font-italic mx-2 my-2"
        x-data="{show: false}"
        x-show.transition.opacity.out.duration.1500ms="show"
        x-init="@this.on('saved', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
        style="display: none"> Logo Updated. </div>
    
     <!-- Delete message -->    
        <div class="font-italic mx-2 my-2"
        x-data="{show: false}"
        x-show.transition.opacity.out.duration.1500ms="show"
        x-init="@this.on('deleted', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
        style="display: none"> Logo Deleted. </div>

    <!-- Error delete message -->    
        <div class="font-italic mx-2 my-2"
        x-data="{show: false}"
        x-show.transition.opacity.out.duration.1500ms="show"
        x-init="@this.on('deletedError', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
        style="display: none"> No image to delete. </div>

</div>
