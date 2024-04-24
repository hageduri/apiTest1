<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <html>
                    <head>
                        <title>List of Data</title>
                    </head>
                    <body>
                        <h1>List of Data</h1>
                        <ul>
                            @foreach($devices as $item)
                                <li>Name: {{ $item->name }}, Member ID: {{ $item->member_id }}</li>
                            @endforeach
                        </ul>

                        <!-- Display pagination links -->
                        {{ $devices->links() }}
                    </body>
                    </html>
            </div>
        </div>
    </div>
</x-app-layout>