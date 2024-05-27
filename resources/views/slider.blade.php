<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Slider Manager') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7x6 mx-auto sm:px-6 lg:px-8">
            <div >
                @livewire('slider_manager')
            </div>
            
    
    
        </div>
    </div>
    </x-app-layout>