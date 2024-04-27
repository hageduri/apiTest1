{{-- <!-- resources/views/livewire/upload-logo.blade.php -->
<div>
    <input type="file" wire:model="image">
    <button wire:click="save">Upload</button>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div>{{ session('error') }}</div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('fileUploaded', () => {
            // Handle file uploaded event (if needed)
        });
    });
</script>
@endpush --}}

<!-- resources/views/livewire/upload-logo.blade.php -->
<div>
    <input type="file" wire:model="image" wire:change="saveHeadLogo">
    <button wire:click="saveHeadLogo">Upload</button>

    @if ($imageName)
        <div>Image Name: {{ $imageName }}</div>
    @endif

    @if ($imagePath)
        <div>Image Path: {{ $imagePath }}</div>
        <img src="{{ $imagePath }}" alt="Uploaded Image">
    @endif

    @if (session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif

    @error('image')
        <div>{{ $message }}</div>
    @enderror
</div>
