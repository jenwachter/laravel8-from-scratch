<x-layout>
  <section class="px-6 py-8">
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
      <h1 class="text-center font-bold text-xl">Register!</h1>

      <form method="POST" action="/register" class="mt-10">

        {{-- Creates a hidden value for protection against CSRF attacks--}}
        @csrf

        <x-form.input name="name" required />
        <x-form.input name="username" required />

        {{-- the autocomplete attribute hints password managers --}}
        <x-form.input name="email" type="email" autcomplete="username" required />
        <x-form.input name="password" type="password" autcomplete="new-password" required />
        <x-form.button>Register</x-form.button>

      </form>
    </main>
  </section>
</x-layout>
