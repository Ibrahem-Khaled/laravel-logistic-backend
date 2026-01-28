<!DOCTYPE html>
<html lang="en" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>الصفحة الرئيسية</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;

        }
    </style>
</head>

<body class="index-page">
    @include('components.header')
    <main class="main">
        @include('components.hero')
        <!-- About Section -->
        <section id="about" class="about section">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 position-relative align-self-start order-lg-last order-first"
                        data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ $web?->about_image ? asset('storage/' . $web?->about_image) : asset('assets/img/about.jpg') }}"
                            class="img-fluid" alt="">
                        {{-- <a href="#" class="glightbox pulsating-play-btn"></a> --}}
                    </div>

                    <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                        <h3>{{ $web?->about_title ?? '' }}</h3>
                        <p>
                            {{ $web?->about_description ?? '' }}
                        </p>
                        @if ($web?->about_features)
                            <ul>
                                @foreach ((json_decode($web?->about_features, true) ?? []) as $feature)
                                    <li>
                                        <i class="bi bi-broadcast"></i>
                                        <div>
                                            <h5>{{ $feature['title'] ?? 'بدون عنوان' }}</h5>
                                            <p>{{ $feature['description'] ?? 'بدون وصف' }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>لا توجد ميزات مضافة</p>
                        @endif

                    </div>
                </div>
            </div>
        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>{{ __('messages.our_services') }}<br></span>
                <h2>{{ __('messages.our_services') }}</h2>
                <p>{{ __('messages.services_description') }}</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">

                    <!-- Card Item 1 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <div class="card-img">
                                <img src="assets/img/service-1.jpg" alt="" class="img-fluid">
                            </div>
                            <h3>{{ __('messages.storage') }}</h3>
                            <p>{{ __('messages.storage_description') }}</p>
                        </div>
                    </div><!-- End Card Item -->

                    <!-- Card Item 2 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="card-img">
                                <img src="assets/img/service-2.jpg" alt="" class="img-fluid">
                            </div>
                            <h3>{{ __('messages.express_air_freight') }}</h3>
                            <p>{{ __('messages.express_air_freight_description') }}</p>
                        </div>
                    </div><!-- End Card Item -->

                    <!-- Card Item 3 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="card">
                            <div class="card-img">
                                <img src="assets/img/service-3.jpg" alt="" class="img-fluid">
                            </div>
                            <h3>{{ __('messages.international_air_shipping') }}</h3>
                            <p>{{ __('messages.international_air_shipping_description') }}</p>
                        </div>
                    </div><!-- End Card Item -->

                </div>
            </div>
        </section><!-- /Services Section -->

        @include('components.contact-us')

        @include('components.location-in-map')
    </main>

    @include('components.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".navmenu a").forEach(anchor => {
                anchor.addEventListener("click", function(e) {
                    // التحقق من أن الرابط داخلي وليس رابط خارجي
                    if (this.getAttribute("href").startsWith("#")) {
                        e.preventDefault(); // منع الانتقال الافتراضي
                        const section = document.querySelector(this.getAttribute("href"));
                        if (section) {
                            section.scrollIntoView({
                                behavior: "smooth", // تمرير سلس
                                block: "start"
                            });
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
