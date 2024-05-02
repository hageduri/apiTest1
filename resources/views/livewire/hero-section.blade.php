<!-- create-hero-section.blade.php -->
<form wire:submit.prevent="saveHeroSection">
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
        <label for="image">Image:</label>
        <input type="file" wire:model="image" id="image" required>
        @error('image') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="sequence">Sequence:</label>
        <input type="number" wire:model="sequence" id="sequence" required>
        @error('sequence') <span>{{ $message }}</span> @enderror
    </div>
    <button type="submit">Submit</button>
</form>