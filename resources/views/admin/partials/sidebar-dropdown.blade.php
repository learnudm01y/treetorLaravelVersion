{{-- Sidebar Dropdown Item --}}
@props(['title', 'icon', 'items', 'active' => false])

@php
    $dropdownId = Str::slug($title);
@endphp

<li x-data="{ open: {{ $active ? 'true' : 'false' }} }">
    <button @click="open = !open"
            class="menu-item group w-full {{ $active ? 'menu-item-active' : 'menu-item-inactive' }} cursor-pointer"
            :class="{ 'lg:justify-center': !sidebarExpanded && !sidebarHovered && !sidebarOpen, 'lg:justify-start': sidebarExpanded || sidebarHovered || sidebarOpen }">
        <span class="menu-item-icon-size {{ $active ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
            {!! $icon !!}
        </span>
        <template x-if="sidebarExpanded || sidebarHovered || sidebarOpen">
            <span class="menu-item-text">{{ $title }}</span>
        </template>
        <template x-if="sidebarExpanded || sidebarHovered || sidebarOpen">
            <svg class="ml-auto w-5 h-5 transition-transform duration-200"
                 :class="{ 'rotate-180 text-brand-500': open }"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 9l6 6 6-6"/>
            </svg>
        </template>
    </button>

    <template x-if="sidebarExpanded || sidebarHovered || sidebarOpen">
        <div x-show="open"
             x-collapse
             class="overflow-hidden">
            <ul class="mt-2 space-y-1 ml-9">
                @foreach($items as $item)
                    @php
                        $isItemActive = Route::has($item['route']) && request()->routeIs($item['route']);
                    @endphp
                    <li>
                        <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                           class="menu-dropdown-item {{ $isItemActive ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }}">
                            {{ $item['title'] }}
                            @if(isset($item['badge']))
                                <span class="ml-auto menu-dropdown-badge {{ $isItemActive ? 'menu-dropdown-badge-active' : 'menu-dropdown-badge-inactive' }}">
                                    {{ $item['badge'] }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </template>
</li>
