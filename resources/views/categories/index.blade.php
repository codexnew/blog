<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Categories</h2></x-slot>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('categories.create') }}" class="bg-gray-900 text-white px-4 py-2 rounded">Add Category</a>
        <div class="mt-4 bg-white rounded shadow">
            @foreach($categories as $category)
                <div class="p-3 border-b flex justify-between">
                    <span>{{ $category->name }} ({{ $category->slug }})</span>
                    <span class="flex gap-2"><a href="{{ route('categories.edit',$category) }}">Edit</a><form method="POST" action="{{ route('categories.destroy',$category) }}">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form></span>
                </div>
            @endforeach
        </div>
        {{ $categories->links() }}
    </div>
</x-app-layout>
