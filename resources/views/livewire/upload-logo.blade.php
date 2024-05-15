<div>
    @if ($imagePath)
        <img src="{{ $imagePath }}" alt="Logo" class="rounded-full h-24 w-24">
    @else
        <div class="bg-gray-200 rounded-full h-24 w-24 flex items-center justify-center text-gray-400">
            No Logo
        </div>
    @endif

    <form wire:submit.prevent="save">
        <input type="file" wire:model="logo">
        @error('logo') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save</button>
    </form>

    @if ($confirmingUpload)
        <div class="confirmation-modal">
            <p>Are you sure you want to upload this logo?</p>
            <button wire:click="save">Yes</button>
            <button wire:click="$set('confirmingUpload', false)">No</button>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="success">{{ session('message') }}</div>
    @endif
</div>
