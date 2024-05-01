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

    public $selectedImageId = null;
    public $confirmingImageDeletion = null;


    public function mount()
    {        
        // Fetch the list of images from the database
        $this->images = head_logo::all();
    }

    public function render()
    {
        
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

         // Store the uploaded file in the local disk
         $path = $this->image->store('images');

         // Get the original name of the uploaded image file
         $this->imageName = $this->image->getClientOriginalName();
 
         // Save the image path and name
        //  $this->imagePath = Storage::url($path);
 
         // Create a new Logo model instance
         $image = new head_logo();
         $image->path = $path; // Assuming 'path' is the database field to store the file path
         $image->name = $this->imageName; // Assuming 'name' is the database field to store the image name
         $image->save();
        
         // Assign the ID of the uploaded logo
        $this->logoId = $image->id;


        

        // Refresh the list of images
        $this->images = head_logo::all();

        // Reset the input field after successful upload
        $this->image = null;

        // Show success message
        session()->flash('message', 'Image uploaded successfully.');
        
    }
    public function setUpdateImage($id)
    {
        $this->selectedImageId = $id;
    }

    public function confirmDelete($id)
    {
        $this->confirmingImageDeletion = $id;
    }
    public function delete($id)
    { // Find the image by ID
        $image = head_logo::find($id);

        if ($image) {
            // Delete the image from storage
            Storage::delete($image->path);
            
            // Delete the image from the database
            $image->delete();

            // Flash success message
            session()->flash('success', 'Image deleted successfully.');

            // Refresh the list of images
            $this->images = head_logo::all();          
        
        }
    }
    public function update($id)
    {
        // $existingImage = head_logo::find($this->selectedImageId);
        $existingImage = head_logo::find($id);
        
        
        if (!$existingImage) {
            // Handle case where no image is uploaded
            session()->flash('error', 'No image uploaded.');
            return;
        }
        
        if ($this->image) {

            // Upload and save the new image
        $newImage = $this->image->store('images');

        
        // Delete the existing image from storage
        Storage::delete($existingImage->path);
        
        // Update the existing image data
        $existingImage->name = $this->image->getClientOriginalName();
        $existingImage->path = $newImage;
        $existingImage->save();

        // Flash success message
        session()->flash('message', 'Image updated successfully.');

        // Refresh the list of images
        $this->images = head_logo::all();         
        
        // Reset the input field after successful upload
        $this->image = null;
        
    }
    else{
        // No new image uploaded
    session()->flash('error', 'No image uploaded.');
    }
}
   
}   