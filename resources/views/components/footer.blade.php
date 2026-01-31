<footer id="footer" class="footer dark-background" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-about {{ app()->getLocale() == 'ar' ? 'text-center text-md-end' : 'text-center text-md-start' }}">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span class="sitename">{{ $web?->site_title ?? '' }}</span>
                </a>
                <p>{{ $web?->site_description ?? '' }}</p>
                <div class="social-links d-flex mt-4">
                    {{-- <a href=""><i class="bi bi-twitter-x"></i></a> --}}
                    <a href="https://www.facebook.com/share/18Bj8iXfvL/?mibextid=wwXIfr" target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://wa.me/+962799102049" target="_blank">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    {{-- <a href=""><i class="bi bi-instagram"></i></a> --}}
                    {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                </div>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact {{ app()->getLocale() == 'ar' ? 'text-center text-md-end' : 'text-center text-md-start' }}">
                <h4>{{ __('messages.footer_contact_title') }}</h4>
                <p class="mb-2">
                    <strong>{{ __('messages.footer_main_branch') }}</strong><br>
                    {{ __('messages.footer_main_branch_address') }}<br>
                    {{ __('messages.phone') }}: <a href="tel:00962799102049" class="text-white text-decoration-none">00962799102049</a>
                </p>
                <p class="mb-2">
                    <strong>{{ __('messages.footer_shafa_badran_branch') }}</strong><br>
                    {{ __('messages.footer_shafa_badran_address') }}<br>
                    <a href="tel:00962791075777" class="text-white text-decoration-none">00962791075777</a>
                </p>
                <p class="mb-0">
                    <strong>{{ __('messages.email') }}:</strong>
                    <a href="mailto:info@kafafiexpress.com" class="text-white text-decoration-none">info@kafafiexpress.com</a>
                </p>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact {{ app()->getLocale() == 'ar' ? 'text-center text-md-start' : 'text-center text-md-end' }}">
                <img src="{{ asset('assets/img/logo-white.png') }}" alt="" class="img-fluid" data-aos="fade-in">
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>{{ __('messages.copyright') }}</span> <strong class="px-1 sitename">kafafiexpress</strong>
            <span>{{ __('messages.all_rights_reserved') }}</span>
        </p>
    </div>

</footer>
