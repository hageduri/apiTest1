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