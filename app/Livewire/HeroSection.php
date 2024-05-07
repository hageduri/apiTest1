<?php

namespace App\Livewire;

use App\Models\heroSection as ModelsHeroSection;
use App\Models\test1;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class HeroSection extends Component
{
    use WithFileUploads;

    public $slides;
    // public $slide = NULL;
    public $slideTitle; // Temporary property to store the selected slide filename
    public $error;
    public $message;
    public $slidePath;
    public $logoId;

    public $selectedslideId = null;
    public $confirmingslideDeletion = null;

    public $title = null ;
    public $description = null;
    // public $image = null;
    public $seqNo = null;
    public $image_path = null;



    public function mount()
    {        
        // Fetch the list of slides from the database
        $this->slides = ModelsHeroSection::all();
    }

    public function render()
    {
        
        return view('livewire.hero-section');
    }
    

    public function saveHeroSection()
    {
         // Check if an slide is selected
        if (!$this->image_path) {
            session()->flash('error', 'Please select an slide.');
            return;
        }

        // $this->title = "apple1";
        // Validate the selected slide
        $validatedData=$this->validate([
            // 'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|image|max:2048',
            'seqNo' => 'required|integer',
        ]);

         // Store the uploaded file in the local disk
         $path = $this->image_path->store('custom/hero_img','public');

         // Get the original name of the uploaded slide file
         $this->title = $this->image_path->getClientOriginalName();
 
         // Save the slide path and name
        //  $this->slidePath = Storage::url($path);
 
         // Create a new Logo model instance
         $slide = new ModelsHeroSection();
            // $slide = test1::create($validatedData);

         $slide->title = $this->title; // Assuming 'name' is the database field to store the slide name
         $slide->description = $this->description; // Assuming 'name' is the database field to store the slide name
         $slide->image_path = $path; // Assuming 'path' is the database field to store the file path
         $slide->seqNo = $this->seqNo;

         $slide->save();
         // $this->description = '';

        // Save the hero section with the image path
        // HeroSection::create(array_merge($validatedData, ['image_path' => $image_path]));
        
         // Assign the ID of the uploaded logo
        // $this->logoId = $slide->id;
      

        // // Refresh the list of slides
        // $this->slides = ModelsHeroSection::all();

        // Reset the input field after successful upload
        // $this->slide = null;

        // Show success message
        session()->flash('message', 'slide uploaded successfully.');

        // $this->resetForm();
        // $this->title = '';
        // $this->image_path->null;
        // $this->seqNo = '';

        // $this->reset(
        //             'description',
        //             // 'image_path',
        //             'seqNo',
        //         );

        return redirect("hero_section")->back();
        // $this->reset();
        
    }
    private function resetForm()
    {
        $this->reset();
    }
    public function setUpdateslide($id)
    {
        $this->selectedslideId = $id;
    }

    public function confirmDelete($id)
    {
        $this->confirmingslideDeletion = $id;
    }
    public function delete($id)
    { // Find the slide by ID
        $slide = ModelsHeroSection::find($id);

        if ($slide) {
            // Delete the slide from storage
            Storage::delete($slide->path);
            
            // Delete the slide from the database
            $slide->delete();

            // Flash success message
            session()->flash('success', 'slide deleted successfully.');

            // Refresh the list of slides
            $this->slides = ModelsHeroSection::all();          
        
        }
    }
    public function update($id)
    {
        // $existingslide = head_logo::find($this->selectedslideId);
        $existingslide = ModelsHeroSection::find($id);
        
        
        if (!$existingslide) {
            // Handle case where no slide is uploaded
            session()->flash('error', 'No slide uploaded.');
            return;
        }
        
        if ($this->slide) {

            // Upload and save the new slide
        $newslide = $this->slide->store('images/hero_img');

        
        // Delete the existing slide from storage
        Storage::delete($existingslide->path);
        
        // Update the existing slide data
        $existingslide->title = $this->slide->getClientOriginalName();
        $existingslide->path = $newslide;
        $existingslide->save();

        // Flash success message
        session()->flash('message', 'slide updated successfully.');

        // Refresh the list of slides
        $this->slides = ModelsHeroSection::all();         
        
        // Reset the input field after successful upload
        // $this->slide = null;
        
    }
    else{
        // No new slide uploaded
    session()->flash('error', 'No slide uploaded.');
    }
}
}
