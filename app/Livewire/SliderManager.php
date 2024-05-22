<?php

namespace App\Livewire;

use App\Models\slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SliderManager extends Component
{
    use WithFileUploads;
    
    public $title;
    public $description;
    public $image_path;
    public $image;
    public $seqNo;

    public $sliders;
    public $editSeqNo = [];

    protected $rules = [
        'title' => 'nullable|string',
        'description' => 'nullable|string',
        'image_path' => 'required|image|mimes:png|max:1024', // 1MB Max
        'seqNo' => 'required|numeric|min:1',
    ];

    public function mount()
    {
        $this->loadSliders();
    }

    public function loadSliders()
    {
        $this->sliders = Slider::orderBy('seqNo')->get();
    }


    public function render()
    {
        $sliders = Slider::orderBy('seqNo')->get();
        return view('livewire.slider-manager', compact('sliders'));
    }

    public function addItem()
    {
        $this->validate();

        // Get the current number of sliders
        $recordCount = Slider::count();

        // Ensure that the seqNo is within the valid range
        if ($this->seqNo > $recordCount + 1) {
            // If the seqNo is greater than the allowed range, set it to the last position
            $this->seqNo = $recordCount + 1;
        }

        // Begin transaction to ensure data consistency
        DB::beginTransaction();

        try {
            // Shift sequence numbers of existing sliders to make space for the new one
            Slider::where('seqNo', '>=', $this->seqNo)->increment('seqNo');

            // Store the uploaded image and get its path
            // $image = $this->imagePath->store('sliders', 'public');

            // Create the new slider with the specified sequence number
            Slider::create([
                'title' => $this->title,
                'description' => $this->description,
                'image_path' => $this->image_path->store('sliders', 'public'),
                'seqNo' => $this->seqNo,
            ]);

            // Commit the transaction
            DB::commit();

            // Reload sliders to update the view
            $this->loadSliders();

            // Reset input fields
            $this->reset(['title', 'description', 'imagePath', 'seqNo']);
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            // Handle the exception (log it or display an error message)
            // For example, you can log the error
            Log::error($e->getMessage());
        }
    }
    public function editSeqNo($sliderId)
    {
        $slider = Slider::find($sliderId);
        $this->editSeqNo[$sliderId] = $slider->seqNo;
    }

    public function saveSeqNo($sliderId)
    {
        $this->validate([
            'editSeqNo.' . $sliderId => 'required|numeric|min:1',
        ]);

        $slider = Slider::find($sliderId);
        $newSeqNo = $this->editSeqNo[$sliderId];

        if ($newSeqNo < 1 || $newSeqNo > Slider::count()) {
            // Invalid seqNo, handle this error appropriately
            return;
        }

        DB::beginTransaction();

        try {
            // Shift sequence numbers to make space for the new seqNo
            if ($newSeqNo > $slider->seqNo) {
                Slider::whereBetween('seqNo', [$slider->seqNo + 1, $newSeqNo])->decrement('seqNo');
            } else {
                Slider::whereBetween('seqNo', [$newSeqNo, $slider->seqNo - 1])->increment('seqNo');
            }

            // Update the slider's sequence number
            $slider->update(['seqNo' => $newSeqNo]);

            DB::commit();

            // Reload sliders to update the view
            $this->loadSliders();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        unset($this->editSeqNo[$sliderId]);
    }
}
