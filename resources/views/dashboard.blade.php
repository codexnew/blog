<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Dashboard</h2></x-slot>
    <div class="py-8 max-w-7xl mx-auto px-4 space-y-4">
        <div class="flex gap-3">
            <a href="{{ route('posts.create') }}" class="bg-gray-900 text-white px-4 py-2 rounded">Create Post</a>
            <a href="{{ route('categories.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded">Categories</a>
            <a href="{{ route('tags.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded">Tags</a>
        </div>
        <div class="bg-white shadow rounded">
            <table class="w-full text-left">
                <thead class="bg-gray-100"><tr><th class="p-3">Title</th><th class="p-3">Status</th><th class="p-3">Category</th><th class="p-3">Actions</th></tr></thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr class="border-t">
                            <td class="p-3">{{ $post->title }}</td>
                            <td class="p-3">{{ ucfirst($post->status) }}</td>
                            <td class="p-3">{{ $post->category->name }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('posts.show',$post->slug) }}" class="text-blue-600">View</a>
                                <a href="{{ route('posts.edit',$post) }}" class="text-yellow-600">Edit</a>
                                <form method="POST" action="{{ route('posts.destroy',$post) }}">@csrf @method('DELETE')<button class="text-red-600" onclick="return confirm('Delete?')">Delete</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="p-3" colspan="4">No posts yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    </div>
</x-app-layout>
