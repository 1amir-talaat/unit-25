<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Display success message if it exists --}}
            @if (session('success'))
                <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 "
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>

                </div>
                @if (session('error'))
                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 "
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('error') }}
                        </div>
                       
                    </div>
                @endif
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($services->isEmpty())
                    <div class="text-center py-20">
                        <h1 class="w-full font-medium text-5xl">No services available.</h1>
                    </div>
                @else
                    <div class="p-6 text-gray-900 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Check if there are services available --}}

                        {{-- Loop through each service --}}
                        @foreach ($services as $service)
                            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow flex flex-col">
                                <a href="#">
                                    <img class="rounded-t-lg" src="{{ asset('services.png') }}" alt="" />
                                </a>
                                <div class="p-5 flex flex-col flex-grow">
                                    <a href="#">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                            {{ $service->name }}</h5>
                                    </a>
                                    <p class="mb-2 font-bold text-gray-800">Price: ${{ $service->price }}</p>
                                    <p class="mb-2 font-bold text-gray-800">Category: {{ $service->category->name }}</p>
                                    <p class="mb-3 font-normal text-gray-700 flex-grow">{{ $service->description }}</p>
                                    {{-- Add a button to apply for the service --}}
                                    <form action="{{ route('services.apply', $service->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                            Apply
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
            @endif
        </div>
    </div>

</x-app-layout>
