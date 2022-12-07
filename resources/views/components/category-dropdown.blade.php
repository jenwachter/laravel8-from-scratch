<x-dropdown>
  <x-slot name="trigger">
    <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
      {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
      <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />
    </button>
  </x-slot>

  <x-dropdown-item href="/" :active="request()->routeIs('home')">All</x-dropdown-item>

  @php
    $querystring = '/?';
    $existingQuerystring = request()->except(['category', 'page']);

    if (!empty($existingQuerystring)) {
      $querystring .= http_build_query($existingQuerystring) . '&';
    }
  @endphp

  @foreach ($categories as $category)
    <x-dropdown-item
      href="{{ $querystring }}category={{ $category->slug }}"
      :active="isset($currentCategory) && $currentCategory->is($category)"
    >
      {{ ucwords($category->name) }}
    </x-dropdown-item>
  @endforeach
</x-dropdown>
