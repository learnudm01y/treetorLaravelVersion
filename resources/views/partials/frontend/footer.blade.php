<footer class="footer">
    <div class="wrapper">
        <div class="footer-top">
            <div class="footer-top__social">
                <span>Find us here:</span>
                <ul>
                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                    <li><a href="#"><i class="icon-insta"></i></a></li>
                    <li><a href="#"><i class="icon-in"></i></a></li>
                </ul>
            </div>
            <div class="footer-top__logo">
                <a href="{{ route('home') }}">
                    <img data-src="{{ asset('img/LOGO-PNG.png') }}"
                         src="data:image/gif;base64,R0lGODlhAQABAAAAACw="
                         class="js-img" alt="Treetor Logo">
                </a>
            </div>
            <div class="footer-top__payments">
                <span>Payment methods:</span>
                <ul>
                    <li><img src="https://placehold.co/60x40/cccccc/666666?text=VISA" alt="Visa"></li>
                    <li><img src="https://placehold.co/60x40/cccccc/666666?text=MC" alt="Mastercard"></li>
                    <li><img src="https://placehold.co/60x40/cccccc/666666?text=AMEX" alt="American Express"></li>
                    <li><img src="https://placehold.co/60x40/cccccc/666666?text=PP" alt="PayPal"></li>
                </ul>
            </div>
        </div>
        <div class="footer-nav">
            <div class="footer-nav__col">
                <span class="footer-nav__col-title">About</span>
                <ul>
                    <li><a href="{{ route('about') }}">About us</a></li>
                    <li><a href="{{ route('services.index') }}">Services</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contacts</a></li>
                </ul>
            </div>
            <div class="footer-nav__col">
                <span class="footer-nav__col-title">Services</span>
                <ul>
                    @php
                        $footerServices = \App\Models\Service::published()->ordered()->take(6)->get();
                    @endphp
                    @foreach($footerServices as $service)
                        <li><a href="{{ route('services.show', $service->slug) }}">{{ Str::limit($service->title, 25) }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-nav__col">
                <span class="footer-nav__col-title">Useful links</span>
                <ul>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="#">Terms of use</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
            <div class="footer-nav__col">
                <span class="footer-nav__col-title">Contact</span>
                <ul>
                    <li><i class="icon-map-pin"></i> Dubai, UAE</li>
                    <li>
                        <i class="icon-phone"></i>
                        <a href="tel:+971586658664">+971 58 665 8664</a>
                    </li>
                    <li><i class="icon-mail"></i><a href="mailto:info@treetor.com">info@treetor.com</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-copy">
            <span>&copy; All rights reserved. Treetor {{ date('Y') }}</span>
        </div>
    </div>
</footer>
