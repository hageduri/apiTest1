<div x-data="{ showCancel: false, showPreview: false, originalLogoLink: '{{ $originalLogoLink }}'}">
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
        <div >
            <input type="file" wire:model="logo" class="mx-2 my-2" x-on:change="showPreview = true">
            @error('logo') <span class="error">{{ $message }}</span> @enderror
        </div>
        
            <div class="mx-2">
                <p>
                <strong>Website Address: </strong> 
                <a class="underline decoration-indigo-500 hover:decoration-blue-400" 
                href="{{ $logok }}">{{ $logok }}</a>
                </p>
            </div>
        
        <input type="text" wire:model="logoL" placeholder="Enter logo link" class="mx-2 mt-2 border rounded p-2"
        x-on:focus="showCancel = true"
        {{-- x-on:blur="showCancel = false" --}}
        x-bind:value="originalLogoLink"
        >
        @error('logoL') <span class="error">{{ $message }}</span> @enderror
        
        <br>

        <x-button class=" bg-blue-500 mx-2 my-2"
        type="button"
        x-on:click="showCancel = false, showPreview = false"
        wire:click.prevent="save"
        wire:confirm="Are you sure you want to save this image?"
        wire:loading.attr="disabled"
    >
        Save
    </x-button>

    <!-- Cancel button to clear preview and hide the preview mode -->
        <x-button type="button" class="bg-yellow-500 text-white px-4 py-2 rounded ml-2"
        x-show="showPreview || showCancel"
        x-on:focus="{showCancel:false}"
        x-on:click="showCancel = false; showPreview = false; $wire.clearLogo(); $wire.logoL = originalLogoLink;"
        >
            Cancel
        </x-button>    
    

    <!-- Delete button, shown only if there's an existing logo -->
        @if ($imagePath && !$logo)
            <x-button class="bg-red-500 mx-2 my-2"
                type="button"
                wire:click.prevent="delete"
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
        style="display: none; background-color: Aquamarine"> Logo Updated. </div>
    
     <!-- Delete message -->    
        <div class="font-italic mx-2 my-2"
        x-data="{show: false}"
        x-show.transition.opacity.out.duration.1500ms="show"
        x-init="@this.on('deleted', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
        style="display: none; background-color: tomato"> 
        <del>Logo Deleted.</del></div>

    <!-- Error delete message -->    
        <div class="font-italic mx-2 my-2"
        x-data="{show: false}"
        x-show.transition.opacity.out.duration.1500ms="show"
        x-init="@this.on('deletedError', () => { show = true; setTimeout(() => { show = false; }, 2000)})"
        style="display: none" > No image to delete.</div>

</div>
