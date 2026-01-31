@extends('layouts.frontend')

@section('title', $service->title)
@section('meta_description', $service->meta_description ?? Str::limit($service->overview, 160))

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/services-new.css') }}">
<style>
    .service-hero {
        background: linear-gradient(135deg, #e8f0ea 0%, #d4e5d8 100%);
        padding: 160px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .service-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="%230d5c47" opacity="0.1"/></svg>');
        opacity: 0.3;
    }

    .service-hero__content {
        position: relative;
        z-index: 1;
        max-width: 800px;
    }

    .service-hero__badge {
        display: inline-block;
        background: linear-gradient(135deg, #0d5c47 0%, #094536 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .service-hero__title {
        font-size: 48px;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .service-hero__subtitle {
        font-size: 20px;
        color: #555;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .service-hero__meta {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }

    .service-hero__meta-item {
        display: flex;
        align-items: center;
        gap: 15px;
        background: white;
        padding: 15px 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        flex: 1;
        min-width: 250px;
    }

    .service-hero__meta-item i {
        font-size: 24px;
        color: #0d5c47;
    }

    .service-hero__meta-item .label {
        display: block;
        font-size: 12px;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .service-hero__meta-item .value {
        display: block;
        font-size: 16px;
        font-weight: 600;
        color: #2c2c2c;
    }

    .service-detail-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .service-detail-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 50px;
    }

    @media (max-width: 1024px) {
        .service-detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .service-hero__title {
            font-size: 32px;
        }

        .service-hero__subtitle {
            font-size: 16px;
        }

        .service-hero__meta {
            gap: 15px;
        }

        .service-hero__meta-item {
            flex: 1;
            min-width: calc(50% - 10px);
            padding: 12px 15px;
            gap: 10px;
        }

        .service-hero__meta-item i {
            font-size: 20px;
        }

        .service-hero__meta-item .label {
            font-size: 10px;
        }

        .service-hero__meta-item .value {
            font-size: 14px;
        }
    }

    .service-detail-main {
        margin-left: 3px;
    }

    .service-detail-image {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .service-detail-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .service-detail-image__overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
        padding: 30px;
    }

    .service-detail-image__overlay span {
        color: white;
        font-size: 18px;
        font-weight: 600;
    }

    .service-detail-block {
        background: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 24px;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 25px;
    }

    .section-title__icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #e8f0ea 0%, #d4e5d8 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0d5c47;
        font-size: 20px;
    }

    .service-detail-description {
        color: #555;
        line-height: 1.8;
        font-size: 16px;
    }

    .service-detail-description p {
        margin-bottom: 15px;
    }

    .service-detail-description strong {
        color: #2c2c2c;
        font-weight: 600;
    }

    .service-detail-description ul,
    .service-detail-description ol {
        padding-left: 25px;
        margin-bottom: 15px;
        list-style: initial !important;
    }

    .service-detail-description ul {
        list-style-type: disc !important;
    }

    .service-detail-description ol {
        list-style-type: decimal !important;
    }

    .service-detail-description li {
        margin-bottom: 8px;
        color: #555;
        display: list-item !important;
        list-style: inherit !important;
    }

    .service-detail-description ul li::marker {
        color: #333;
    }

    .service-detail-description ol li::marker {
        color: #333;
        font-weight: 600;
    }

    .service-detail-description h1,
    .service-detail-description h2,
    .service-detail-description h3,
    .service-detail-description h4 {
        color: #2c2c2c;
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .service-detail-description h1 { font-size: 28px; }
    .service-detail-description h2 { font-size: 24px; }
    .service-detail-description h3 { font-size: 20px; }
    .service-detail-description h4 { font-size: 18px; }

    .service-detail-description a {
        color: #0d5c47;
        text-decoration: underline;
    }

    .service-detail-description a:hover {
        color: #094536;
    }

    .service-detail-description blockquote {
        border-left: 4px solid #0d5c47;
        padding-left: 20px;
        margin: 20px 0;
        font-style: italic;
        color: #666;
    }

    .service-features-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .service-features-list li {
        display: flex;
        gap: 20px;
        padding: 25px 0;
        border-bottom: 1px solid #eee;
    }

    .service-features-list li:last-child {
        border-bottom: none;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        min-width: 60px;
        min-height: 60px;
        background: linear-gradient(135deg, #0d5c47 0%, #094536 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-left: 15px;
    }

    .feature-icon i {
        font-size: 24px;
        color: white;
    }

    .feature-content h4 {
        font-size: 18px;
        font-weight: 600;
        color: #2c2c2c;
        margin-bottom: 8px;
        text-align: left;
        direction: ltr;
    }

    .feature-content h4:lang(ar),
    .feature-content h4:has([lang="ar"]) {
        text-align: right;
        direction: rtl;
    }

    .feature-content p {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
        margin: 0;
        text-align: left;
        direction: ltr;
    }

    .feature-content p:lang(ar) {
        text-align: right;
        direction: rtl;
    }

    /* Auto-detect RTL for Arabic content */
    .feature-content h4,
    .feature-content p {
        unicode-bidi: plaintext;
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    @media (max-width: 768px) {
        .benefits-grid {
            grid-template-columns: 1fr;
        }
    }

    .benefit-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        border: 1px solid #eee;
        transition: all 0.3s ease;
    }

    .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .benefit-card__icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #0d5c47 0%, #094536 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .benefit-card__icon i {
        font-size: 24px;
        color: white;
    }

    .benefit-card h4 {
        font-size: 16px;
        font-weight: 600;
        color: #2c2c2c;
        margin-bottom: 8px;
    }

    .benefit-card p {
        color: #666;
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
    }

    /* Sidebar Styles */
    .service-detail-sidebar {
        /* Sidebar container */
    }

    .service-booking-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 100px;
        margin-bottom: 30px;
        margin-left: -7px;
    }

    .service-booking-card__header {
        text-align: center;
        margin-bottom: 25px;
        border-radius: 18px;
    }

    .booking-card-title {
        font-size: 22px;
        font-weight: 700;
        color: #ffffff;
    }

    .service-booking-card__features {
        margin-bottom: 25px;
    }

    .quick-feature {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }

    .quick-feature:last-child {
        border-bottom: none;
    }

    .quick-feature i {
        color: #0d5c47;
        font-size: 18px;
    }

    .quick-feature span {
        color: #555;
        font-size: 15px;
    }

    .service-booking-card__pricing {
        text-align: center;
        padding: 25px 0;
        border-top: 2px solid #f0f0f0;
        border-bottom: 2px solid #f0f0f0;
        margin: 20px 0;
    }

    .pricing-label {
        color: #888;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .pricing-value {
        color: #0d5c47;
        font-size: 32px;
        font-weight: 700;
    }

    .pricing-note {
        color: #666;
        font-size: 13px;
        margin-top: 5px;
    }

    .service-booking-card__action {
        margin-bottom: 20px;
    }

    .service-booking-card__action .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: white;
        padding: 18px 20px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        text-align: center;
        word-break: break-word;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 100%;
    }

    .service-booking-card__action .btn i {
        font-size: 20px;
        flex-shrink: 0;
    }

    .service-booking-card__action .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4);
    }

    .service-booking-card__note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
    }

    .service-booking-card__note i {
        color: #0d5c47;
        font-size: 16px;
        margin-top: 2px;
    }

    .service-booking-card__note p {
        color: #666;
        font-size: 13px;
        line-height: 1.5;
        margin: 0;
    }

    /* Mobile Responsive Styles for All Devices */
    @media (max-width: 1024px) {
        .service-detail-main {
            margin-left: 3px;
        }

        .service-booking-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 100px;
            margin-bottom: 30px;
            margin-left: -7px;
        }
    }

    @media (max-width: 768px) {
        .service-detail-main {
            margin-left: 3px;
        }

        .service-booking-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: static;
            margin-bottom: 30px;
            margin-left: -7px;
        }
    }

    @media (max-width: 480px) {
        .service-detail-main {
            margin-left: 3px;
        }

        .service-booking-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: static;
            margin-bottom: 20px;
            margin-left: -7px;
        }
    }

    @media (max-width: 375px) {
        .service-detail-main {
            margin-left: 3px;
        }

        .service-booking-card {
            background: white;
            border-radius: 15px;
            padding: 18px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: static;
            margin-bottom: 20px;
            margin-left: -7px;
        }
    }

    @media (max-width: 320px) {
        .service-detail-main {
            margin-left: 3px;
        }

        .service-booking-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: static;
            margin-bottom: 15px;
            margin-left: -7px;
        }
    }

    .service-info-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .service-info-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #2c2c2c;
        margin-bottom: 15px;
    }

    .service-info-card p {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .link-arrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #0d5c47;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .link-arrow:hover {
        gap: 12px;
    }

    .link-arrow::after {
        content: '→';
    }
</style>
@endpush

@section('content')
    <!-- Service Detail Hero -->
    <div class="service-hero">
        <div class="wrapper">
            <div class="service-hero__content">
                @if($service->badge)
                    <div class="service-hero__badge">{{ $service->badge }}</div>
                @endif
                <h1 class="service-hero__title">{{ $service->title }}</h1>
                @if($service->subtitle)
                    <p class="service-hero__subtitle">{{ $service->subtitle }}</p>
                @endif

                <div class="service-hero__meta">
                    @if($service->icon)
                        <div class="service-hero__meta-item">
                            <i class="{{ $service->icon }}"></i>
                            <div>
                                <span class="label">Service Type</span>
                                <span class="value">{{ $service->badge ?? 'Professional Service' }}</span>
                            </div>
                        </div>
                    @endif
                    @if($service->price_type)
                        <div class="service-hero__meta-item">
                            <i class="fas fa-tag"></i>
                            <div>
                                <span class="label">Pricing</span>
                                <span class="value">{{ $service->formatted_price }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Service Detail Content -->
    <div class="service-detail-section">
        <div class="wrapper">
            <div class="service-detail-grid">

                <!-- Main Content Column -->
                <div class="service-detail-main">

                    <!-- Image Gallery -->
                    @if($service->featured_image)
                        <div class="service-detail-image">
                            <img src="{{ Storage::url($service->featured_image) }}" alt="{{ $service->title }}">
                            <div class="service-detail-image__overlay">
                                <span>{{ $service->badge ?? 'Expert Business Analysis' }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Overview Section -->
                    @if($service->overview)
                        <div class="service-detail-block">
                            <h2 class="section-title">
                                <span class="section-title__icon"><i class="fas fa-file-alt"></i></span>
                                Service Overview
                            </h2>
                            <div class="service-detail-description">
                                {!! nl2br(e($service->overview)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Full Description -->
                    @if($service->content)
                        <div class="service-detail-block">
                            <h2 class="section-title">
                                <span class="section-title__icon"><i class="fas fa-align-left"></i></span>
                                Full Description
                            </h2>
                            <div class="service-detail-description prose prose-green max-w-none">
                                {!! $service->content !!}
                            </div>
                        </div>
                    @endif

                    <!-- Features Section -->
                    @php
                        $hasValidFeatures = false;
                        if($service->features && is_array($service->features)) {
                            foreach($service->features as $f) {
                                if(!empty($f['title'])) {
                                    $hasValidFeatures = true;
                                    break;
                                }
                            }
                        }
                    @endphp
                    @if($hasValidFeatures)
                        <div class="service-detail-block">
                            <h2 class="section-title">
                                <span class="section-title__icon"><i class="fas fa-search"></i></span>
                                What's Included
                            </h2>
                            <ul class="service-features-list">
                                @foreach($service->features as $feature)
                                    @if(!empty($feature['title']))
                                        <li>
                                            <div class="feature-icon">
                                                <i class="{{ $feature['icon'] ?? 'fas fa-check' }}"></i>
                                            </div>
                                            <div class="feature-content">
                                                <h4 dir="auto">{{ $feature['title'] }}</h4>
                                                @if(!empty($feature['description']))
                                                    <p dir="auto">{{ $feature['description'] }}</p>
                                                @endif
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Benefits Section -->
                    @php
                        $hasValidBenefits = false;
                        if($service->benefits && is_array($service->benefits)) {
                            foreach($service->benefits as $b) {
                                if(!empty($b['title'])) {
                                    $hasValidBenefits = true;
                                    break;
                                }
                            }
                        }
                    @endphp
                    @if($hasValidBenefits)
                        <div class="service-detail-block service-benefits">
                            <h2 class="section-title">
                                <span class="section-title__icon"><i class="fas fa-star"></i></span>
                                Benefits
                            </h2>
                            <div class="benefits-grid">
                                @foreach($service->benefits as $benefit)
                                    @if(!empty($benefit['title']))
                                        <div class="benefit-card">
                                            <div class="benefit-card__icon">
                                                <i class="{{ $benefit['icon'] ?? 'fas fa-star' }}"></i>
                                            </div>
                                            <h4 dir="auto">{{ $benefit['title'] }}</h4>
                                            @if(!empty($benefit['description']))
                                                <p dir="auto">{{ $benefit['description'] }}</p>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Ideal For Section -->
                    @php
                        $hasValidIdealFor = false;
                        if($service->ideal_for && is_array($service->ideal_for)) {
                            foreach($service->ideal_for as $i) {
                                if(!empty($i['title'])) {
                                    $hasValidIdealFor = true;
                                    break;
                                }
                            }
                        }
                    @endphp
                    @if($hasValidIdealFor)
                        <div class="service-detail-block">
                            <h2 class="section-title">
                                <span class="section-title__icon"><i class="fas fa-gem"></i></span>
                                Ideal For
                            </h2>
                            <ul class="service-features-list">
                                @foreach($service->ideal_for as $item)
                                    @if(!empty($item['title']))
                                        <li>
                                            <div class="feature-icon" style="background: linear-gradient(135deg, #27ae60 0%, #1e8449 100%);">
                                                <i class="{{ $item['icon'] ?? 'fas fa-check-circle' }}"></i>
                                            </div>
                                            <div class="feature-content">
                                                <h4 dir="auto">{{ $item['title'] }}</h4>
                                                @if(!empty($item['description']))
                                                    <p dir="auto">{{ $item['description'] }}</p>
                                                @endif
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

                <!-- Sidebar Column -->
                <div class="service-detail-sidebar">

                    <!-- Booking Card -->
                    <div class="service-booking-card">
                        <div class="service-booking-card__header">
                            <h3 class="booking-card-title">{{ $service->cta_text ?? 'Book This Service' }}</h3>
                        </div>

                        @if($service->quick_features && count($service->quick_features) > 0)
                            <div class="service-booking-card__features">
                                @foreach($service->quick_features as $qf)
                                    @if(!empty($qf['text']))
                                        <div class="quick-feature">
                                            <i class="fas fa-check-circle"></i>
                                            <span>{{ $qf['text'] }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="service-booking-card__features">
                                <div class="quick-feature">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Professional Service</span>
                                </div>
                                <div class="quick-feature">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Expert Consulting</span>
                                </div>
                                <div class="quick-feature">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Detailed Report</span>
                                </div>
                            </div>
                        @endif

                        <div class="service-booking-card__pricing">
                            <div class="pricing-label">
                                @if($service->price_type === 'from')
                                    Starting From
                                @elseif($service->price_type === 'contact')
                                    Pricing
                                @else
                                    Price
                                @endif
                            </div>
                            <div class="pricing-value">{{ $service->formatted_price }}</div>
                            @if($service->price_note)
                                <div class="pricing-note">{{ $service->price_note }}</div>
                            @endif
                        </div>

                        <div class="service-booking-card__action">
                            <a href="https://wa.me/{{ $service->whatsapp_number ?? '971586658664' }}" class="btn" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                {{ $service->cta_text ?? 'Book Consultation' }}
                            </a>
                        </div>

                        <div class="service-booking-card__note">
                            <i class="fas fa-info-circle"></i>
                            <p>Contact us for customized pricing based on your specific needs</p>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="service-info-card">
                        <h3>Need Help?</h3>
                        <p>Our team is ready to answer any questions you may have about this service.</p>
                        <a href="{{ route('contact') }}" class="link-arrow">Contact Support</a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- Related Services --}}
    @if($relatedServices->count() > 0)
        <div class="related-services-section">
            <div class="wrapper">
                <h2 class="related-services-title">Other Services</h2>
                <div class="related-services-grid">
                    @foreach($relatedServices as $related)
                        <a href="{{ route('services.show', $related->slug) }}" class="related-service-card">
                            <div class="related-service-card__image">
                                @if($related->featured_image)
                                    <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}">
                                @else
                                    <i class="{{ $related->icon ?? 'fas fa-concierge-bell' }}"></i>
                                @endif
                            </div>
                            <div class="related-service-card__content">
                                <h3>{{ $related->title }}</h3>
                                <p>{{ Str::limit($related->subtitle ?? $related->overview, 80) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .related-services-section {
        background: #fff;
        padding: 80px 0;
    }

    .related-services-title {
        text-align: center;
        font-size: 36px;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 50px;
    }

    .related-services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .related-service-card {
        display: block;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .related-service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .related-service-card__image {
        height: 200px;
        background: linear-gradient(135deg, #0d5c47 0%, #094536 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .related-service-card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .related-service-card:hover .related-service-card__image img {
        transform: scale(1.05);
    }

    .related-service-card__image i {
        font-size: 50px;
        color: rgba(255,255,255,0.3);
    }

    .related-service-card__content {
        padding: 25px;
    }

    .related-service-card__content h3 {
        font-size: 18px;
        font-weight: 600;
        color: #2c2c2c;
        margin-bottom: 10px;
    }

    .related-service-card__content p {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
        margin: 0;
    }

    /* Responsive Design for Mobile */
    @media (max-width: 992px) {
        .related-services-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .related-services-title {
            font-size: 32px;
            margin-bottom: 40px;
        }

        .related-services-section {
            padding: 60px 0;
        }
    }

    @media (max-width: 768px) {
        .related-services-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .related-services-title {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .related-services-section {
            padding: 50px 0;
        }

        .related-service-card__image {
            height: 180px;
        }

        .related-service-card__content {
            padding: 20px;
        }

        .related-service-card__content h3 {
            font-size: 16px;
        }

        .related-service-card__content p {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .related-services-title {
            font-size: 24px;
            margin-bottom: 25px;
        }

        .related-service-card__image {
            height: 160px;
        }

        .related-service-card__content {
            padding: 18px;
        }
    }
</style>
@endpush
