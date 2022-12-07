<x-layout>

  <x-setting heading="Edit: {{ $post->title }}">
    <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
      @csrf

      {{-- browsers don't understand PATCH requests through forms, so this directive gives Laravel a hint --}}
      {{-- <input type="hidden" name="_method" value="PATCH"> --}}
      @method('PATCH')

      <x-form.input name="title" :value="old('title', $post->title)" required />
      <x-form.input name="slug" :value="old('title', $post->slug)" required />

      <div class="flex mt-6">
        <div class="flex-1">
          <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
        </div>
        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
      </div>

      <x-form.textarea name="excerpt" required>{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
      <x-form.textarea name="body" required>{{ old('body', $post->body) }}</x-form.textarea>

      @php
        $categories = \App\Models\Category::all()->map(fn ($category) => ['value' => $category->id, 'display' => ucwords($category->name)]);
      @endphp
      <x-form.select name="category_id" :options="$categories" :value="$post->category_id" />

      <x-form.button>Update</x-form.button>
    </form>
  </x-setting>

</x-layout>
