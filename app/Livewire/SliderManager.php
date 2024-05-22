<?php

namespace App\Livewire;

use App\Models\slider;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SliderManager extends Component
{
    use WithFileUploads;
    public $list = [];
    public $newItem;

    public $title;
    public $description;
    public $imagePath;
    public $seqNo;

    public function mount()
    {
        // Fetch data from the database and populate the list
        $this->list = slider::all()->toArray();
    }
    

    public function addItem($seqNo)
    {
        // Validate if the new item and seqNo are not empty
        $this->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'imagePath' => 'required|string',
            'seqNo' => 'required|numeric|min:1',
        ]);

        // Get the number of existing records
        $recordCount = slider::count();
        // dd($recordCount);

        // Ensure that the seqNo is within the range of valid positions
        if ($seqNo > $recordCount + 1) {
            // Return an error response or handle the invalid seqNo scenario
            return;
        }

        // Get the last sequential ID from the database
        
        $lastID = slider::max('id');

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Shift IDs of existing records
            for ($i = $lastID; $i >= $seqNo; $i--) {
                slider::where('id', $i)->update(['id' => $i + 1]);
            }

            // Insert new record at the specified position
            slider::create([
                'id' => $seqNo,
                'title' => $this->title,
                'description' => $this->description,
                'image_path' => $this->imagePath,
                'seqNo' => $seqNo,
            ]);

            // Commit the transaction
            DB::commit();

            // Update the list
            $this->list = slider::all()->toArray();

            // Reset the input fields
            $this->reset(['title', 'description', 'imagePath']);
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollback();
            // Handle the exception
            // You can log the error or show an error message to the user
        }
    }

    public function render()
        {
            // $sliders = slider::all();
            return view('livewire.slider-manager');
        }

}
