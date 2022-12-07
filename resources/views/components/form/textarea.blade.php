@props(['name'])

<x-form.container :name="$name">

  <textarea class="border border-gray-200 p-2 w-full rounded"
            name="{{ $name }}"
            id="{{ $name }}"
  >{{ $slot ?? old('$name') }}</textarea>

</x-form.container>
