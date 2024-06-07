<?php

namespace App\Livewire;

use App\Models\noticeTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
// use Livewire\WithFileUploads as LivewireWithFileUploads;

class Notice extends Component
{
    use WithFileUploads;

    public $name=null;
    public $file_path;
    public $ffile=null;

    public function mount()
    {
        $this->ffile = noticeTable::first();
    }
    
    protected $rules = [
        'name' => 'nullable|string',
        // 'file_path' => 'required',
    ];

    public function save()
    {
        $this->validate();
        // $fPath = $this->file_path->store('notice', 'public');
        dd($this->file_path);
        // dd($this->name);
        
        
        // DB::beginTransaction();

        // try {
            
        //     $fPath = $this->file_path->store('notice', 'public');
        //     noticeTable::create([
        //         'name' => $this->name,
        //         'file_path' => $fPath,
        //     ]);

        //     DB::commit();
        //     $this->dispatch('saved');
        //     $this->reset(['name', 'file_path']);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error($e->getMessage());
        // }
        
    }     

    public function render()
    {
        return view('livewire.notice');
    }
}
