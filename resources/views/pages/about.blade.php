@extends('layouts.frontend')

@section('title', 'About Us')
@section('meta_description', 'Learn about Treetor - Expert salon coaching and consulting services')

@section('content')
    <!-- BEGIN DETAIL MAIN BLOCK -->
    <div class="detail-block detail-block_margin">
        <div class="wrapper">
            <div class="detail-block__content">
                <h1>About Us</h1>
                <ul class="bread-crumbs">
                    <li class="bread-crumbs__item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="bread-crumbs__item">About Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- DETAIL MAIN BLOCK EOF -->

    <!-- BEGIN ABOUT SECTION -->
    <section style="padding: 100px 0;">
        <div class="wrapper">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                <div>
                    <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=800&h=600&fit=crop" alt="About Treetor" style="border-radius: 20px; width: 100%; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                </div>
                <div>
                    <span class="saint-text" style="color: #0d5c47;">Who We Are</span>
                    <h2 style="font-size: 42px; font-weight: 700; color: #2c2c2c; margin: 15px 0 25px;">Expert Salon Consulting</h2>
                    <p style="color: #666; font-size: 17px; line-height: 1.8; margin-bottom: 20px;">
                        Treetor is a premium consulting agency specializing in beauty salon management, coaching, and business optimization. With years of industry experience, we help salon owners transform their businesses into high-performing, profitable enterprises.
                    </p>
                    <p style="color: #666; font-size: 17px; line-height: 1.8; margin-bottom: 30px;">
                        Our team of experts provides comprehensive solutions covering everything from operational efficiency and financial management to marketing strategies and staff training. We believe every salon has the potential to thrive with the right guidance and support.
                    </p>
                    <a href="{{ route('services.index') }}" class="btn">Explore Our Services</a>
                </div>
            </div>
        </div>
    </section>
    <!-- ABOUT SECTION EOF -->

    <!-- BEGIN VALUES SECTION -->
    <section style="padding: 100px 0; background: #f8f9fa;">
        <div class="wrapper">
            <div style="text-align: center; margin-bottom: 60px;">
                <span class="saint-text" style="color: #0d5c47;">Our Values</span>
                <h2 style="font-size: 42px; font-weight: 700; color: #2c2c2c; margin-top: 10px;">What Drives Us</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                <div style="background: white; border-radius: 20px; padding: 40px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #0d5c47 0%, #094536 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="fas fa-star" style="font-size: 32px; color: white;"></i>
                    </div>
                    <h3 style="font-size: 22px; font-weight: 600; color: #2c2c2c; margin-bottom: 15px;">Excellence</h3>
                    <p style="color: #666; font-size: 16px; line-height: 1.7;">We strive for excellence in everything we do, ensuring our clients receive the highest quality consulting services.</p>
                </div>
                <div style="background: white; border-radius: 20px; padding: 40px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #0d5c47 0%, #094536 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="fas fa-handshake" style="font-size: 32px; color: white;"></i>
                    </div>
                    <h3 style="font-size: 22px; font-weight: 600; color: #2c2c2c; margin-bottom: 15px;">Partnership</h3>
                    <p style="color: #666; font-size: 16px; line-height: 1.7;">We work alongside our clients as true partners, invested in their success and committed to achieving their goals.</p>
                </div>
                <div style="background: white; border-radius: 20px; padding: 40px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #0d5c47 0%, #094536 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="fas fa-lightbulb" style="font-size: 32px; color: white;"></i>
                    </div>
                    <h3 style="font-size: 22px; font-weight: 600; color: #2c2c2c; margin-bottom: 15px;">Innovation</h3>
                    <p style="color: #666; font-size: 16px; line-height: 1.7;">We continuously evolve our methods and strategies to stay ahead of industry trends and deliver innovative solutions.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- VALUES SECTION EOF -->

    <!-- BEGIN STATS SECTION -->
    <section style="padding: 100px 0; background: linear-gradient(135deg, #0d5c47 0%, #094536 100%); color: white;">
        <div class="wrapper">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; text-align: center;">
                <div>
                    <div style="font-size: 56px; font-weight: 700; margin-bottom: 10px;">50+</div>
                    <div style="font-size: 18px; color: rgba(255,255,255,0.8);">Salons Transformed</div>
                </div>
                <div>
                    <div style="font-size: 56px; font-weight: 700; margin-bottom: 10px;">10+</div>
                    <div style="font-size: 18px; color: rgba(255,255,255,0.8);">Years Experience</div>
                </div>
                <div>
                    <div style="font-size: 56px; font-weight: 700; margin-bottom: 10px;">95%</div>
                    <div style="font-size: 18px; color: rgba(255,255,255,0.8);">Client Satisfaction</div>
                </div>
                <div>
                    <div style="font-size: 56px; font-weight: 700; margin-bottom: 10px;">200+</div>
                    <div style="font-size: 18px; color: rgba(255,255,255,0.8);">Training Sessions</div>
                </div>
            </div>
        </div>
    </section>
    <!-- STATS SECTION EOF -->

    <!-- BEGIN CTA SECTION -->
    <section style="padding: 100px 0; text-align: center;">
        <div class="wrapper">
            <span class="saint-text" style="color: #0d5c47;">Get In Touch</span>
            <h2 style="font-size: 42px; font-weight: 700; color: #2c2c2c; margin: 15px 0 25px;">Ready to Work Together?</h2>
            <p style="max-width: 650px; margin: 0 auto 35px; color: #666; font-size: 18px; line-height: 1.7;">Let's discuss how we can help transform your salon into a thriving business.</p>
            <a href="{{ route('contact') }}" class="btn">Contact Us</a>
        </div>
    </section>
    <!-- CTA SECTION EOF -->
@endsection

@push('styles')
<style>
    @media (max-width: 992px) {
        section > .wrapper > div[style*="grid-template-columns: 1fr 1fr"],
        section > .wrapper > div[style*="grid-template-columns: repeat(3"] {
            grid-template-columns: 1fr !important;
        }

        section > .wrapper > div[style*="grid-template-columns: repeat(4"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        section > .wrapper > div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush
