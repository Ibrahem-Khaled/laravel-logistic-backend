  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials section dark-background">

      <img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="swiper init-swiper">
              <script type="application/json" class="swiper-config">
    {
      "loop": true,
      "speed": 600,
      "autoplay": {
        "delay": 5000
      },
      "slidesPerView": "auto",
      "pagination": {
        "el": ".swiper-pagination",
        "type": "bullets",
        "clickable": true
      }
    }
  </script>
              <div class="swiper-wrapper">
                  @foreach ($clients as $item)
                      <div class="swiper-slide">
                          <div class="testimonial-item">
                              <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                  alt="">
                              <h3>{{ $item->name }}</h3>
                              <h4>Ceo &amp; Founder</h4>
                              <div class="stars">
                                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                      class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                      class="bi bi-star-fill"></i>
                              </div>
                              <p>
                                  <i class="bi bi-quote quote-icon-left"></i>
                                  <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum
                                      suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et.
                                      Maecen aliquam, risus at semper.</span>
                                  <i class="bi bi-quote quote-icon-right"></i>
                              </p>
                          </div>
                      </div><!-- End testimonial item -->
                  @endforeach
              </div>
              <div class="swiper-pagination"></div>
          </div>
      </div>
  </section><!-- /Testimonials Section -->
