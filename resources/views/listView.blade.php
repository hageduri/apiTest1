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
                        <style>
                            th, td {
                                padding: 10px; /* Add padding to increase space between cells */
                            }
                        </style>
                    </head>
                    <body>
                        <h1>List of Devices</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>Serial No.</th>
                                    <th>Name</th>
                                    <th>Member ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $device->name }}</td>
                                        <td>{{ $device->member_id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Display pagination links -->
                        {{ $devices->links() }}
                    </html>
            </div>
        </div>
    </div>
</x-app-layout>