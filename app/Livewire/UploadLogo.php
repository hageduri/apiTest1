<?php

namespace App\Livewire;

use App\Models\head_logo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadLogo extends Component
{
    use WithFileUploads;
    public $logo=null;
    public $logoL;

    public function mount()
    {
        $existingLogo = head_logo::first();
        if ($existingLogo) {
            $this->logoL = $existingLogo->logolink;
        }
    }
    public function render()
    {
        $logo = head_logo::first();
        $imagePath = $logo ? asset('storage/' . $logo->path) : null;
        logger($imagePath); // Log the image path

        return view('livewire.upload-logo', [
            'imagePath' => $imagePath,
            'logok' => $this->logoL,
        ]);
    }

    public function save()
    {
        $this->validate([
            'logo' => 'nullable|image|max:1024', // 1MB Max
            'logoL' => 'nullable|url',
        ]);

        if ($existingLogo = head_logo::first()) {
                // If a logo already exists, update it
                $existingLogo->update([
                    'name' => $this->logo->getClientOriginalName(),
                    'path' => $this->logo->store('logos', 'public'),
                    'logolink' => $this->logoL,
                ]);
            } else {
                // If no logo exists, create a new one
                head_logo::create([
                    'name' => $this->logo->getClientOriginalName(),
                    'path' => $this->logo->store('logos', 'public'),
                    'logolink' => $this->logoL,
                ]);
            }

            // Reset the form and confirmation flag
            $this->logo = null;
            
            // Dispatch browser event to trigger JavaScript
            $this->dispatch('saved');   
        
    }

    public function delete()
    {
        $existingLogo = head_logo::first();
        
        if ($existingLogo) {
            // Delete the image from storage
            Storage::disk('public')->delete($existingLogo->path);
            // Delete the logo record from the database
            $existingLogo->delete();
            $this->logoL = null;

            $this->dispatch('deleted');
        } else {
            // Set error message if no logo found
            $this->dispatch('deletedError');
        }

        // Dispatch event for showing success message
        
    }

    public function clearLogo()
    {
        // Clear the logo preview
        $this->logo = null;
    }

}