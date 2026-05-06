<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Editorial</p>
            <h2 class="font-semibold text-3xl text-slate-900">Latest Posts</h2>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 py-10 grid lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3 space-y-6">
            @if(session('success'))<div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 rounded-xl">{{ session('success') }}</div>@endif
            @forelse($posts as $post)
                <article class="surface-card p-6">
                    <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500 uppercase tracking-wider">
                        <span>{{ $post->category->name }}</span>
                        <span>•</span>
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mt-2 leading-tight">
                        <a class="hover:text-slate-700 transition-colors" href="{{ route('posts.show',$post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-sm text-slate-500 mt-2">By {{ $post->user->name }} | {{ ucfirst($post->status) }}</p>
                    <p class="mt-4 text-slate-700 leading-7">{{ \Illuminate\Support\Str::limit($post->content, 180) }}</p>
                </article>
            @empty
                <div class="surface-card p-6">No posts found.</div>
            @endforelse
            {{ $posts->links() }}
        </div>
        <aside class="surface-card p-5 h-fit sticky top-24">
            <h4 class="font-bold mb-4 text-slate-900">Archive</h4>
            <ul class="space-y-2 text-sm">
                @forelse($archives as $archive)
                    <li><a class="soft-link" href="{{ route('posts.archive',[$archive->year,$archive->month]) }}">{{ \Carbon\Carbon::create($archive->year,$archive->month,1)->format('F Y') }} ({{ $archive->post_count }})</a></li>
                @empty
                    <li>No archive yet.</li>
                @endforelse
            </ul>
        </aside>
    </div>
</x-app-layout>
