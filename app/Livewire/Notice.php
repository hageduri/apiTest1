<?php

namespace App\Livewire;

use App\Models\noticeTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithFileUploads as LivewireWithFileUploads;

class Notice extends Component
{
    use LivewireWithFileUploads;

    public $name=null;
    public $file_path=null;
    
    

    public function save()
    {
        $this->validate([
            'name' => 'nullable|string',
            'file_path' => 'required|file|mimes:pdf|max:102400', // Max 10MB
        ]);

        
        
        DB::beginTransaction();

        try {
            
            $fPath = $this->file_path->store('notice', 'public');
            noticeTable::create([
                'name' => $this->name,
                'file_path' => $fPath,
            ]);

            DB::commit();
            $this->dispatch('saved');
            $this->reset(['name', 'file_path']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        
    }     

    public function render()
    {
        return view('livewire.notice');
    }
}
