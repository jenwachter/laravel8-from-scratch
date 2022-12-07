@props(['name'])

<x-form.container :name="$name">

  <input class="border border-gray-200 p-2 w-full rounded"
         name="{{ $name }}"
         id="{{ $name }}"
         {{ $attributes(['type' => 'text', 'value' => old($name)]) }}
  >

</x-form.container>
