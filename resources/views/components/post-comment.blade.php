@props(['comment'])

<x-panel class="bg-gray-50">
  <article class="flex p-6 space-x-4">
    <div class="flex-shrink-0">
      <img src="https://i.pravatar.cc/100?u={{ $comment->author->id }}" alt="" width="60" class="rounded-xl" />
    </div>
    <div>
      <header class="mb-4">
        <h3 class="font-bold">{{ $comment->author->name }}</h3>
        <p class="text-xs">Posted <time>{{ $comment->created_at->format('F j, Y g:i a') }}</time></p>
      </header>
      {!! $comment->body !!}
    </div>
  </article>
</x-panel>
