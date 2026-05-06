<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tags</h2></x-slot>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('tags.create') }}" class="bg-gray-900 text-white px-4 py-2 rounded">Add Tag</a>
        <div class="mt-4 bg-white rounded shadow">
            @foreach($tags as $tag)
                <div class="p-3 border-b flex justify-between">
                    <span>{{ $tag->name }} ({{ $tag->slug }})</span>
                    <span class="flex gap-2"><a href="{{ route('tags.edit',$tag) }}">Edit</a><form method="POST" action="{{ route('tags.destroy',$tag) }}">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form></span>
                </div>
            @endforeach
        </div>
        {{ $tags->links() }}
    </div>
</x-app-layout>
