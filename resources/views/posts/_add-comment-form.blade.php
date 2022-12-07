@auth
  <x-panel>
    <form method="POST" action="/posts/{{ $post->id }}/comments">
      @csrf

      <header class="flex items-center">
        <img src="https://i.pravatar.cc/100?u={{ auth()->id() }}" alt="" width="40" class="rounded-full" />
        <p class="ml-4">Want to participate?</p>
      </header>

      <div class="mt-8">
        <textarea name="body" class="w-full text-sm focus:outline-none focus:ring" rows="5" placeholder="Enter your comment." required></textarea>
        <x-form.error name="body" />
      </div>

      <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
        <x-form.button>Post</x-form.button>
      </div>

    </form>
  </x-panel>
@else
  <a href="/login" class="ml-6 text-xs font-bold uppercase">Login to comment</a>
@endguest
