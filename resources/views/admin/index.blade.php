<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('All Services') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        @if ($services->isEmpty())
        <p>No services found.</p>
        @else
        <ul>
          @foreach ($services as $service)
          <li>
            {{ $service->name }}
            <a href="{{ route('admin.services.show', $service->id) }}">View</a>
            <a href="{{ route('admin.services.edit', $service->id) }}">Edit</a>
            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </li>
          @endforeach
        </ul>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>