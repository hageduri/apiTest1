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

        <x-button class="mx-2 my-2"
        type="button"
        wire:click.prevent="save"
        wire:confirm="Are you sure you want to save this image?"
        x-on:change="showPreview = true"
        wire:loading.attr="disabled"
    >
        Save
    </x-button>
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

</div>
