<footer id="footer" class="footer dark-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-about">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span class="sitename">{{ $web->site_title ?? '' }}</span>
                </a>
                <p>{{ $web->site_description ?? '' }}</p>
                <div class="social-links d-flex mt-4">
                    {{-- <a href=""><i class="bi bi-twitter-x"></i></a> --}}
                    <a href="https://www.facebook.com/share/18Bj8iXfvL/?mibextid=wwXIfr" target="_blank"><i
                            class="bi bi-facebook"></i></a>
                     <a href="https://wa.me/+962799102049" target="_blank"><i class="bi bi-whatsapp"></i></a>
                    {{-- <a href=""><i class="bi bi-instagram"></i></a> --}}
                    {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                </div>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>Contact Us</h4>
                <p>Amman - jordan
                    Down town
                    Alsalt street - king hussain street</p>
                <p>Jordan</p>
                <a class="mt-4 text-white" href="tel:+00962799102049"><strong>Phone:</strong> <span>+962799102049</span></a>
                <br>
                <a href="mailto:info@kafafiexpress.com" class="text-white"><strong>Email:</strong> <span>info@kafafiexpress.com</span></a>
            </div>
            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-end">
                <img src="{{ asset('assets/img/logo-white.png') }}" alt="" class="img-fluid" data-aos="fade-in">
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">kafafiexpress</strong> <span>All Rights
                Reserved</span>
        </p>

    </div>

</footer>
