<!-- resources/views/admin/categories/index.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Service Categories') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <h1 class="text-xl font-semibold mb-4">All Service Categories</h1>
            <div class="mb-4">
              <a href="{{ route('admin.categories.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Create New Category</a>
            </div>
          </div>

          <!-- Display success message if it exists -->
          @if (session('success'))
          <div id="alert" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
              {{ session('success') }}
            </div>
          </div>
          @endif

          <div class="overflow-x-auto">
            @if (!$categories->isEmpty())
            <table class="min-w-full bg-white">
              <thead>
                <tr>
                  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    ID
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Name
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Description
                  </th>
                  <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($categories as $category)
                <tr>
                  <td class="px-6 py-4 whitespace-no-wrap">{{ $category->id }}</td>
                  <td class="px-6 py-4 whitespace-no-wrap">{{ $category->name }}</td>
                  <td class="px-6 py-4 whitespace-no-wrap">{{ $category->description }}</td>
                  <td class="px-6 py-4 whitespace-no-wrap">
                    <div class="flex items-center space-x-2">
                      <!-- Edit Button -->
                      <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
                      <!-- Delete Button -->
                      <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <h1>No Service Categories found</h1>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>