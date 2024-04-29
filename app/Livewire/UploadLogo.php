<?php

namespace App\Livewire;

use App\Models\head_logo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadLogo extends Component
{
    use WithFileUploads;

    public $images;
    public $image;
    public $imageName; // Temporary property to store the selected image filename
    public $error;
    public $message;
    public $imagePath;
    public $logoId;

    public function render()
    {
        $this->images= head_logo::all();
        return view('livewire.upload-logo');
    }

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
         $path = $this->image->storePublicly('images/logos', 'public');
        //  $path = $this->image->store('logos');

         // Get the original name of the uploaded image file
         $this->imageName = $this->image->getClientOriginalName();
 
         // Save the image path and name
         $this->imagePath = Storage::url($path);
 
         // Create a new Logo model instance
         $image = new head_logo();
         $image->path = $path; // Assuming 'path' is the database field to store the file path
         $image->name = $this->imageName; // Assuming 'name' is the database field to store the image name
         $image->save();
        
         // Assign the ID of the uploaded logo
        $this->logoId = $image->id;


        // Reset the input field after successful upload
        $this->image = null;

        // Show success message
        session()->flash('message', 'Image uploaded successfully.');

        $this->reset();
    }

    public function delete($id)
    { // Find the image by ID
        $image = head_logo::find($id);

        if ($image) {
            // Delete the image from storage
            Storage::delete($image->path);
            // Delete the image from storage
            // Delete the image from the database
            $image->delete();

            // Flash success message
            session()->flash('success', 'Image deleted successfully.');

            // Refresh the list of images
            $this->images = head_logo::all();
        }
    }
}