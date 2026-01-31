{{-- Single Sidebar Item --}}
@props(['title', 'route', 'icon', 'active' => false])

<li>
    <a href="{{ Route::has($route) ? route($route) : '#' }}"
       class="menu-item group {{ $active ? 'menu-item-active' : 'menu-item-inactive' }}"
       :class="{ 'lg:justify-center': !sidebarExpanded && !sidebarHovered && !sidebarOpen, 'lg:justify-start': sidebarExpanded || sidebarHovered || sidebarOpen }">
        <span class="menu-item-icon-size {{ $active ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
            {!! $icon !!}
        </span>
        <template x-if="sidebarExpanded || sidebarHovered || sidebarOpen">
            <span class="menu-item-text">{{ $title }}</span>
        </template>
    </a>
</li>
