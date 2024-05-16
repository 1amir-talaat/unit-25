<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        Apply
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
