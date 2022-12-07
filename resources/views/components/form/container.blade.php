@props(['name'])

<div class="mb-6">
  <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
         for="{{ $name }}"
  >
    {{ ucwords($name) }}
  </label>

  {{ $slot }}

  <x-form.error :name="$name" />
</div>
