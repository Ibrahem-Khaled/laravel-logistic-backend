<!-- Call To Action Section -->
<section id="contact" class="call-to-action section dark-background">

    <img src="{{ asset('assets/img/cta-bg.jpg') }}" alt="">

    <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
            <div class="col-xl-10">
                <div class="text-center">
                    <!-- العنوان المبدع -->
                    <h3>{{ __('messages.title') }}</h3>

                    <!-- الوصف المبدع -->
                    <p>{{ __('messages.description') }}</p>

                    <!-- زر الواتساب -->
                    <a class="cta-btn" href="https://wa.me/+962799102049?text={{ __('messages.whatsapp_message') }}"
                        target="_blank">
                        <i class="bi bi-whatsapp"></i> {{ __('messages.button_text') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

</section><!-- /Call To Action Section -->
