@props(['name', 'options' => [], 'value' => ''])

<x-form.container :name="$name">

  <select name="category_id" id="category_id">
    @foreach ($options as $option)
      <option
        value="{{ $option['value'] }}"
        {{ old($name, $value) == $option['value'] ? 'selected' : '' }}
      >{{ ucwords($option['display']) }}</option>
    @endforeach
  </select>

</x-form.container>
