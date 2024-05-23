<!-- resources/views/livewire/slider-manager.blade.php -->

<div>
    <!-- Form to add a new slider -->
    <form wire:submit.prevent="addItem" enctype="multipart/form-data">
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
            <label for="image_path">Image:</label>
            <input type="file" id="image_path" wire:model="image_path">
            @error('image_path') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="seqNo">Sequence Number:</label>
            <input type="number" id="seqNo" wire:model="seqNo" min="1">
            @error('seqNo') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit">Add Slider</button>
    </form>

    <!-- Display the list of sliders -->
    <ul>
        @foreach ($sliders as $slider)
            <li>
                <strong>Title:</strong> {{ $slider->title }},
                <strong>Description:</strong> {{ $slider->description }},
                <strong>Image:</strong> <img src="{{ Storage::url($slider->image_path) }}" alt="{{ $slider->title }}" width="100" />,
                <strong>SeqNo:</strong>
                @if (isset($editSeqNo[$slider->id]))
                    <input type="number" wire:model.lazy="editSeqNo.{{ $slider->id }}">
                    <button wire:click="saveSeqNo({{ $slider->id }})">Save</button>
                @else
                    {{ $slider->seqNo }}
                    <button wire:click="editSeqNo({{ $slider->id }})">Edit</button>
                @endif
            </li>
        @endforeach
    </ul>
</div>
