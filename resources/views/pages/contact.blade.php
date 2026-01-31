@extends('layouts.frontend')

@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with Treetor for expert salon consulting services')

@section('content')
    <!-- BEGIN DETAIL MAIN BLOCK -->
    <div class="detail-block detail-block_margin">
        <div class="wrapper">
            <div class="detail-block__content">
                <h1>Contact</h1>
                <ul class="bread-crumbs">
                    <li class="bread-crumbs__item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="bread-crumbs__item">Contact</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- DETAIL MAIN BLOCK EOF -->

    <!-- BEGIN CONTACTS -->
    <div class="contacts">
        <div class="wrapper">
            <div class="contacts-wrap">
                <!-- Left Side: Info -->
                <div class="contacts-left">
                    <div class="contacts-header">
                        <span class="contacts-label">Contact Us</span>
                        <h2 class="contacts-title">Get In Touch</h2>
                        <p class="contacts-desc">We'd love to hear from you. Get in touch with us for any inquiries about our salon consulting services.</p>
                    </div>

                    <div class="contacts-details">
                        <div class="contact-item">
                            <div class="contact-item__icon">
                                <i class="icon-map-pin"></i>
                            </div>
                            <div class="contact-item__text">
                                <strong>Address</strong>
                                <span>Dubai, United Arab Emirates</span>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-item__icon">
                                <i class="icon-phone"></i>
                            </div>
                            <div class="contact-item__text">
                                <strong>Phone</strong>
                                <a href="tel:+971586658664">+971 58 665 8664</a>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-item__icon">
                                <i class="icon-mail"></i>
                            </div>
                            <div class="contact-item__text">
                                <strong>Email</strong>
                                <a href="mailto:info@treetor.com">info@treetor.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="contacts-social">
                        <span>Follow us:</span>
                        <div class="contacts-social__links">
                            <a href="#"><i class="icon-facebook"></i></a>
                            <a href="#"><i class="icon-twitter"></i></a>
                            <a href="#"><i class="icon-insta"></i></a>
                            <a href="#"><i class="icon-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Form -->
                <div class="contacts-right">
                    <div class="contacts-form-card">
                        @if(session('success'))
                            <div class="alert-success">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif

                        <h3>Send us a message</h3>
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-input @error('name') is-invalid @enderror"
                                       placeholder="Your Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-input @error('email') is-invalid @enderror"
                                           placeholder="Your Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" class="form-input @error('phone') is-invalid @enderror"
                                           placeholder="Your Phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="message" class="form-input form-textarea @error('message') is-invalid @enderror"
                                          placeholder="Your Message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="form-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACTS EOF -->

    <!-- BEGIN WHATSAPP CTA -->
    <section style="padding: 80px 0; background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); text-align: center;">
        <div class="wrapper">
            <h2 style="font-size: 36px; font-weight: 700; color: white; margin-bottom: 20px;">
                <i class="fab fa-whatsapp" style="margin-right: 15px;"></i>Prefer WhatsApp?
            </h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 18px; margin-bottom: 30px;">Get instant response by messaging us on WhatsApp</p>
            <a href="https://wa.me/971586658664" target="_blank"
               style="display: inline-flex; align-items: center; gap: 10px; background: white; color: #25D366; padding: 18px 40px; border-radius: 50px; font-size: 18px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
                Chat on WhatsApp
            </a>
        </div>
    </section>
    <!-- WHATSAPP CTA EOF -->

    <!-- BEGIN MAP -->
    <section class="contacts-map-section" style="padding: 0; margin: 0; width: 100%; height: 500px; display: block; overflow: hidden;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d462560.6828020104!2d54.897846727339234!3d25.076280448481455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2s!4v1702650000000!5m2!1sen!2s"
            width="100%"
            height="500"
            style="border:0; display: block; margin: 0; padding: 0;"
            allowfullscreen=""
            loading="eager"
            referrerpolicy="no-referrer-when-downgrade"
            title="Dubai Location Map">
        </iframe>
    </section>
    <!-- MAP EOF -->
@endsection

@push('styles')
<style>
    /* ========== CONTACTS SECTION ========== */
    .contacts {
        padding: 80px 0;
        background: #f9fafb;
    }

    .contacts-wrap {
        display: flex;
        gap: 60px;
        align-items: flex-start;
    }

    /* ===== LEFT SIDE ===== */
    .contacts-left {
        flex: 1;
        max-width: 500px;
    }

    .contacts-header {
        margin-bottom: 40px;
    }

    .contacts-label {
        display: inline-block;
        font-size: 13px;
        font-weight: 600;
        color: #0d5c47;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
    }

    .contacts-title {
        font-size: 42px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 16px;
        line-height: 1.2;
    }

    .contacts-desc {
        font-size: 16px;
        color: #666;
        line-height: 1.7;
        margin: 0;
    }

    /* Contact Details */
    .contacts-details {
        display: flex;
        flex-direction: column;
        gap: 24px;
        margin-bottom: 36px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 18px;
    }

    .contact-item__icon {
        width: 52px;
        height: 52px;
        background: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        flex-shrink: 0;
    }

    .contact-item__icon i {
        font-size: 22px;
        color: #0d5c47;
    }

    .contact-item__text {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding-top: 4px;
    }

    .contact-item__text strong {
        font-size: 15px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .contact-item__text span,
    .contact-item__text a {
        font-size: 15px;
        color: #555;
        text-decoration: none;
    }

    .contact-item__text a:hover {
        color: #0d5c47;
    }

    /* Social Links */
    .contacts-social {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .contacts-social > span {
        font-size: 15px;
        font-weight: 600;
        color: #333;
    }

    .contacts-social__links {
        display: flex;
        gap: 10px;
    }

    .contacts-social__links a {
        width: 44px;
        height: 44px;
        background: #fff !important;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999 !important;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        transition: all 0.25s ease;
    }

    .contacts-social__links a:hover {
        background: #0d5c47 !important;
        color: #fff !important;
        transform: translateY(-3px);
    }

    .contacts-social__links a i,
    .contacts-social__links a i::before {
        font-size: 18px !important;
        color: #999 !important;
    }

    .contacts-social__links a:hover i,
    .contacts-social__links a:hover i::before {
        color: #fff !important;
    }

    /* ===== RIGHT SIDE - FORM ===== */
    .contacts-right {
        flex: 1;
        max-width: 480px;
    }

    .contacts-form-card {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 50px rgba(0,0,0,0.08);
    }

    .contacts-form-card h3 {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0 0 28px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 18px;
    }

    .form-row {
        display: flex;
        gap: 16px;
    }

    .form-row .form-group {
        flex: 1;
    }

    .form-input {
        width: 100%;
        padding: 16px 20px;
        font-size: 15px;
        color: #333;
        background: #f8f9fa;
        border: 2px solid transparent;
        border-radius: 12px;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-input:focus {
        background: #fff;
        border-color: #0d5c47;
        box-shadow: 0 0 0 4px rgba(13,92,71,0.1);
    }

    .form-input::placeholder {
        color: #999;
    }

    .form-textarea {
        min-height: 140px;
        resize: vertical;
    }

    .form-error {
        display: block;
        color: #dc3545;
        font-size: 13px;
        margin-top: 6px;
    }

    .form-btn {
        width: 100%;
        padding: 18px 32px;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        background: #0d5c47;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.25s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-btn:hover {
        background: #095039;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13,92,71,0.3);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .contacts-wrap {
            flex-direction: column;
            gap: 50px;
        }

        .contacts-left,
        .contacts-right {
            max-width: 100%;
            width: 100%;
        }

        .contacts-title {
            font-size: 34px;
        }
    }

    @media (max-width: 576px) {
        .contacts {
            padding: 50px 0;
        }

        .contacts-form-card {
            padding: 28px 24px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .contacts-title {
            font-size: 28px;
        }

        .contact-item__icon {
            width: 46px;
            height: 46px;
        }
    }
</style>
@endpush


