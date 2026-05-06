<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Archive: {{ \Carbon\Carbon::create($year,$month,1)->format('F Y') }}</h2></x-slot>
    <div class="max-w-7xl mx-auto px-4 py-8 grid lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 space-y-4">@foreach($posts as $post)<article class="bg-white p-5 rounded shadow"><h3 class="text-xl font-bold"><a href="{{ route('posts.show',$post->slug) }}">{{ $post->title }}</a></h3></article>@endforeach {{ $posts->links() }}</div>
        <aside class="bg-white p-5 rounded shadow h-fit"><h4 class="font-bold mb-3">Archive</h4><ul class="space-y-2 text-sm">@foreach($archives as $archive)<li><a class="text-blue-600" href="{{ route('posts.archive',[$archive->year,$archive->month]) }}">{{ \Carbon\Carbon::create($archive->year,$archive->month,1)->format('F Y') }} ({{ $archive->post_count }})</a></li>@endforeach</ul></aside>
    </div>
</x-app-layout>
