<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ $post->title }}</h2></x-slot>
    <div class="max-w-7xl mx-auto px-4 py-8 grid lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <article class="bg-white p-6 rounded shadow">
                <p class="text-sm text-gray-500">{{ $post->category->name }} | {{ $post->created_at->format('M d, Y') }} | By {{ $post->user->name }}</p>
                @if($post->featured_image)<img src="{{ $post->featured_image }}" class="w-full h-72 object-cover rounded my-4" alt="{{ $post->title }}">@endif
                <div class="prose max-w-none">{!! nl2br(e($post->content)) !!}</div>
                <div class="mt-4 flex gap-2 flex-wrap">@foreach($post->tags as $tag)<span class="bg-gray-200 px-2 py-1 rounded text-sm">#{{ $tag->name }}</span>@endforeach</div>
                @auth
                    @if(auth()->id()===$post->user_id)
                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('posts.edit',$post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                            <form method="POST" action="{{ route('posts.destroy',$post) }}">@csrf @method('DELETE')<button class="bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Delete this post?')">Delete</button></form>
                        </div>
                    @endif
                @endauth
            </article>

            <section class="bg-white p-6 rounded shadow">
                <h3 class="font-bold text-lg mb-3">Comments</h3>
                @auth
                    <form method="POST" action="{{ route('comments.store') }}" class="mb-4">@csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="content" class="w-full border rounded p-2" rows="3" required></textarea>
                        <button class="mt-2 bg-gray-900 text-white px-4 py-2 rounded">Add Comment</button>
                    </form>
                @else
                    <p class="mb-4 text-sm">Please <a class="text-blue-600" href="{{ route('login') }}">login</a> to comment.</p>
                @endauth
                <div class="space-y-4">
                    @forelse($post->comments as $comment)
                        <div class="border-b pb-3">
                            <p class="text-sm text-gray-500">{{ $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}</p>
                            <p>{{ $comment->content }}</p>
                            @auth
                                @if(auth()->id()===$comment->user_id || auth()->id()===$post->user_id || auth()->user()->email==='admin@example.com')
                                    <form method="POST" action="{{ route('comments.destroy',$comment) }}" class="mt-1">@csrf @method('DELETE')<button class="text-red-600 text-sm">Delete</button></form>
                                @endif
                            @endauth
                        </div>
                    @empty <p>No comments yet.</p> @endforelse
                </div>
            </section>

            <section class="bg-white p-6 rounded shadow">
                <h3 class="font-bold text-lg mb-3">Related Posts</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    @forelse($relatedPosts as $related)
                        <a class="border rounded p-3 block hover:bg-gray-50" href="{{ route('posts.show',$related->slug) }}">{{ $related->title }}</a>
                    @empty <p>No related posts found.</p> @endforelse
                </div>
            </section>
        </div>
        <aside class="bg-white p-5 rounded shadow h-fit">
            <h4 class="font-bold mb-3">Archive</h4>
            <ul class="space-y-2 text-sm">@foreach($archives as $archive)<li><a class="text-blue-600" href="{{ route('posts.archive',[$archive->year,$archive->month]) }}">{{ \Carbon\Carbon::create($archive->year,$archive->month,1)->format('F Y') }} ({{ $archive->post_count }})</a></li>@endforeach</ul>
        </aside>
    </div>
</x-app-layout>
