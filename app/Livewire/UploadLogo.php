<?php

namespace App\Livewire;

use App\Models\head_logo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadLogo extends Component
{
    use WithFileUploads;

    public $image;
    public $imageName; // Temporary property to store the selected image filename
    public $error;
    public $message;
    public $imagePath;

    // public function render()
    // {
    //     return view('livewire.upload-logo');
    // }

    public function saveHeadLogo()
    {
         // Check if an image is selected
        if (!$this->image) {
            session()->flash('error', 'Please select an image.');
            return;
        }

        // Validate the selected image
        $this->validate([
            'image' => 'image|max:2048', // Adjust validation rules as needed
        ]);

         // Store the uploaded file
         $path = $this->image->store('images/logos');

         // Get the original name of the uploaded image file
         $this->imageName = $this->image->getClientOriginalName();
 
         // Save the image path and name
         $this->imagePath = Storage::url($path);
 
         // Create a new Logo model instance
         $image = new head_logo();
         $image->path = $path; // Assuming 'path' is the database field to store the file path
         $image->name = $this->imageName; // Assuming 'name' is the database field to store the image name
         $image->save();
 


        // Reset the input field after successful upload
        $this->image = null;

        // Show success message
        session()->flash('message', 'Image uploaded successfully.');

        $this->reset();
    }
}