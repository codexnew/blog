<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</h2></x-slot>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <form method="POST" action="{{ isset($post) ? route('posts.update',$post) : route('posts.store') }}" class="bg-white p-6 rounded shadow space-y-4">
            @csrf
            @if(isset($post)) @method('PUT') @endif
            <input name="title" value="{{ old('title',$post->title ?? '') }}" class="w-full border rounded p-2" placeholder="Title" required>
            <input name="slug" value="{{ old('slug',$post->slug ?? '') }}" class="w-full border rounded p-2" placeholder="Slug (optional)">
            <textarea name="content" rows="8" class="w-full border rounded p-2" placeholder="Content" required>{{ old('content',$post->content ?? '') }}</textarea>
            <input name="featured_image" value="{{ old('featured_image',$post->featured_image ?? '') }}" class="w-full border rounded p-2" placeholder="Featured Image URL">
            <select name="category_id" class="w-full border rounded p-2" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id',$post->category_id ?? '')==$category->id)>{{ $category->name }}</option>@endforeach
            </select>
            <div>
                <p class="font-medium mb-1">Tags</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($tags as $tag)
                        <label><input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : [])))> {{ $tag->name }}</label>
                    @endforeach
                </div>
            </div>
            <select name="status" class="w-full border rounded p-2" required>
                <option value="draft" @selected(old('status',$post->status ?? 'draft')==='draft')>Draft</option>
                <option value="published" @selected(old('status',$post->status ?? '')==='published')>Published</option>
            </select>
            <button class="bg-gray-900 text-white px-5 py-2 rounded">{{ isset($post) ? 'Update' : 'Publish' }}</button>
        </form>
    </div>
</x-app-layout>
