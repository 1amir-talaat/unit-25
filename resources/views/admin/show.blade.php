<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Service Details') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h1>{{ $service->name }}</h1>
        <p>{{ $service->description }}</p>
        <!-- Add any other details you want to display -->
      </div>
    </div>
  </div>
</x-app-layout>