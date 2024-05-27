<?php

namespace App\Livewire;

use App\Models\slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SliderManager extends Component
{
    use WithFileUploads;
    public $title;
    public $description;
    public $image_path;
    public $seqNo;
    public $editSeqNo = [];
    public $sliders = [];

    protected $rules = [
        'title' => 'nullable|string',
        'description' => 'nullable|string',
        'image_path' => 'required|image|max:4048|dimensions:width=1400,height=437', // 4MB Max
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
        
        return view('livewire.slider-manager', ['sliders' => $this->sliders]);
    }

    public function addItem()
    {
        $this->validate();

        $recordCount = Slider::count();
        if ($this->seqNo > $recordCount + 1) {
            $this->seqNo = $recordCount + 1;
        }

        DB::beginTransaction();

        try {
            Slider::where('seqNo', '>=', $this->seqNo)->increment('seqNo');
            $imagePath = $this->image_path->store('sliders', 'public');
            Slider::create([
                'title' => $this->title,
                'description' => $this->description,
                'image_path' => $imagePath,
                'seqNo' => $this->seqNo,
            ]);
            DB::commit();
            $this->dispatch('saved');
            $this->loadSliders();
            $this->reset(['title', 'description', 'image_path', 'seqNo']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        
        unset($this->$recordCount);
    }

    public function editSeqNo1($sliderId)
    {
        // dd($sliderId);
        $slider1 = Slider::find($sliderId);
        $d = $this->editSeqNo[$sliderId] = $slider1->seqNo;
    }

    public function saveSeqNo($sliderId)
    {
        
        // dd($sliderId);
        $this->validate([
            'editSeqNo.' . $sliderId => 'required|numeric|min:1',
        ]);

        $slider3 = Slider::find($sliderId);
        $newSeqNo = $this->editSeqNo[$sliderId];

        if ($newSeqNo < 1 || $newSeqNo > Slider::count()) {
            return;
        }

        DB::beginTransaction();

        try {
            if ($newSeqNo > $slider3->seqNo) {
                Slider::whereBetween('seqNo', [$slider3->seqNo + 1, $newSeqNo])->decrement('seqNo');
            } else {
                Slider::whereBetween('seqNo', [$newSeqNo, $slider3->seqNo - 1])->increment('seqNo');
            }
            $slider3->update(['seqNo' => $newSeqNo]);
            DB::commit();
            $this->dispatch('SeqNum');
            $this->loadSliders();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        unset($this->editSeqNo[$sliderId]);
    }

    public function clearSeq(){
        // Clear the logo preview
        $this->editSeqNo = null;
    }

    public function deleteItem($sliderId)
    {
        $slider = Slider::find($sliderId);
        if ($slider) {
            DB::beginTransaction();
            try {
                // Delete the image from storage
                Storage::disk('public')->delete($slider->image_path);

                Slider::where('seqNo', '>', $slider->seqNo)->decrement('seqNo');
                $slider->delete();
                DB::commit();
                $this->dispatch('deleted');
                $this->loadSliders();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
            }
        }
    }
}