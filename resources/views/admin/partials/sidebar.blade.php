{{-- Admin Sidebar --}}
<aside class="fixed mt-16 flex flex-col lg:mt-0 top-0 px-5 left-0 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-50 border-r border-gray-200"
       :class="{
           'w-[290px]': sidebarExpanded || sidebarOpen || sidebarHovered,
           'w-[90px]': !sidebarExpanded && !sidebarOpen && !sidebarHovered,
           'translate-x-0': sidebarOpen,
           '-translate-x-full lg:translate-x-0': !sidebarOpen
       }"
       @mouseenter="if (!sidebarExpanded) sidebarHovered = true"
       @mouseleave="sidebarHovered = false">

    {{-- Logo Section --}}
    <div class="py-8 flex"
         :class="{ 'lg:justify-center': !sidebarExpanded && !sidebarHovered, 'justify-start': sidebarExpanded || sidebarHovered || sidebarOpen }">
        <a href="{{ route('admin.dashboard') }}">
            <template x-if="sidebarExpanded || sidebarHovered || sidebarOpen">
                <div>
                    <img src="{{ asset('images/logo/LOGO-PNG.png') }}" alt="Treetor Logo" width="150" height="40" class="object-contain">
                </div>
            </template>
            <template x-if="!sidebarExpanded && !sidebarHovered && !sidebarOpen">
                <img src="{{ asset('images/logo/back_logo.png') }}" alt="Treetor Logo" width="40" height="40" class="hidden lg:block object-contain">
            </template>
        </a>
    </div>

    {{-- Navigation Menu --}}
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <nav class="mb-6">
            <div class="flex flex-col gap-4">
                {{-- Main Menu --}}
                <div>
                    <h2 class="mb-4 text-xs uppercase flex leading-[20px] text-gray-400"
                        :class="{ 'lg:justify-center': !sidebarExpanded && !sidebarHovered, 'justify-start': sidebarExpanded || sidebarHovered || sidebarOpen }">
                        <template x-if="sidebarExpanded || sidebarHovered || sidebarOpen">
                            <span>Menu</span>
                        </template>
                        <template x-if="!sidebarExpanded && !sidebarHovered && !sidebarOpen">
                            <span class="hidden lg:block">
                                <svg class="size-6 fill-current" viewBox="0 0 24 24">
                                    <circle cx="5" cy="12" r="2"/>
                                    <circle cx="12" cy="12" r="2"/>
                                    <circle cx="19" cy="12" r="2"/>
                                </svg>
                            </span>
                        </template>
                    </h2>

                    <ul class="flex flex-col gap-4">
                        {{-- Dashboard --}}
                        @include('admin.partials.sidebar-item', [
                            'title' => 'Dashboard',
                            'route' => 'admin.dashboard',
                            'icon' => '<svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3.5 10.5L12 3L20.5 10.5V20.5H15V14.5H9V20.5H3.5V10.5Z"/></svg>',
                            'active' => request()->routeIs('admin.dashboard')
                        ])

                        {{-- Articles Dropdown --}}
                        @include('admin.partials.sidebar-dropdown', [
                            'title' => 'Articles',
                            'icon' => '<svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>',
                            'items' => [
                                ['title' => 'All Articles', 'route' => 'admin.articles.index'],
                                ['title' => 'Create New', 'route' => 'admin.articles.create'],
                            ],
                            'active' => request()->routeIs('admin.articles.*')
                        ])

                        {{-- Services Dropdown --}}
                        @include('admin.partials.sidebar-dropdown', [
                            'title' => 'Services',
                            'icon' => '<svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>',
                            'items' => [
                                ['title' => 'All Services', 'route' => 'admin.services.index'],
                                ['title' => 'Create New', 'route' => 'admin.services.create'],
                            ],
                            'active' => request()->routeIs('admin.services.*')
                        ])
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</aside>
