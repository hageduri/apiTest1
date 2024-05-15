<?php

namespace App\Livewire;

use App\Models\head_logo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UploadLogo extends Component
{
    use WithFileUploads;
    public $logo;
    public $confirmingUpload = false;

    public function render()
    {
        $logo = head_logo::first();
        $imagePath = $logo ? asset('storage/' . $logo->path) : null;
        logger($imagePath); // Log the image path

        return view('livewire.upload-logo', [
            'imagePath' => $imagePath,
        ]);
    }

    public function save()
    {
        $this->validate([
            'logo' => 'image|max:1024', // 1MB Max
        ]);

        if ($this->confirmingUpload) {
            if ($existingLogo = head_logo::first()) {
                // If a logo already exists, update it
                $existingLogo->update([
                    'name' => $this->logo->getClientOriginalName(),
                    'path' => $this->logo->store('logos', 'public'),
                ]);
            } else {
                // If no logo exists, create a new one
                head_logo::create([
                    'name' => $this->logo->getClientOriginalName(),
                    'path' => $this->logo->store('logos', 'public'),
                ]);
            }

            // Show success message
            session()->flash('message', 'Logo uploaded successfully!');

            // Reset the form and confirmation flag
            $this->logo = null;
            $this->confirmingUpload = false;
        } else {
            // Ask for confirmation before uploading
            $this->confirmingUpload = true;
        }
    }

}