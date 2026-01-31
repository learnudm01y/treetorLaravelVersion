<header class="header">
    <div class="header-content">
        <div class="header-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/LOGO-PNG.png') }}" alt="Treetor Logo">
            </a>
        </div>
        <div class="header-box">
            <ul class="header-nav">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About us</a></li>
                <li><a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a></li>
                <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
            <ul class="header-options">
                <li><a href="#" id="openSearchModal"><i class="icon-search"></i></a></li>
            </ul>
        </div>
        <div class="btn-menu js-btn-menu"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>
    </div>
</header>
