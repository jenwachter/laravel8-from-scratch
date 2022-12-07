<x-layout>

  <x-setting heading="Create new post">
    <form method="POST" action="/admin/posts" enctype="multipart/form-data">
      @csrf

      <x-form.input name="title" required />
      <x-form.input name="slug" required />
      <x-form.input name="thumbnail" type="file" required />
      <x-form.textarea name="excerpt" required />
      <x-form.textarea name="body" required />

      @php
        $categories = \App\Models\Category::all()->map(fn ($category) => ['value' => $category->id, 'display' => ucwords($category->name)]);
      @endphp
      <x-form.select name="category_id" :options="$categories" />

      <x-form.button>Create</x-form.button>
    </form>
  </x-setting>

</x-layout>
