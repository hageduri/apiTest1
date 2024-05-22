<!-- resources/views/livewire/linked-list.blade.php -->

<div>
    <!-- Form to add a new item -->
    <form wire:submit.prevent="addItem({{ $seqNo }})">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" wire:model="title">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" wire:model="description">
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="imagePath">Image Path:</label>
            <input type="text" id="imagePath" wire:model="imagePath">
            @error('imagePath') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="seqNo">Sequence Number:</label>
            <input type="number" id="seqNo" wire:model="seqNo" min="1">
            @error('seqNo') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit">Add Item</button>
    </form>

    <!-- Display the list of items -->
    <ul>
        @foreach ($list as $item)
            <li>
                <strong>Title:</strong> {{ $item['title'] }},
                <strong>Description:</strong> {{ $item['description'] }},
                <strong>Image Path:</strong> {{ $item['image_path'] }},
                <strong>SeqNo:</strong> {{ $item['seqNo'] }}
            </li>
        @endforeach
    </ul>
</div>
