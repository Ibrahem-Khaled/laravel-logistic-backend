<!-- Hero Section -->
<section id="home" class="hero section dark-background">
    <img src="{{ asset('assets/img/world-dotted-map.png') }}" alt="" class="hero-bg" data-aos="fade-in">

    <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h2 data-aos="fade-up">{{ $web->hero_title ?? '' }}</h2>
                <p data-aos="fade-up" data-aos-delay="100">{{ $web->hero_description ?? '' }}</p>
                <!-- نموذج البحث -->
                <form id="tracking-form" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up"
                    data-aos-delay="200">
                    <!-- اختيار الشركة -->
                    <select id="company" class="form-select me-2" required>
                        <option value="" disabled selected>{{ __('messages.select_company') }}</option>
                        <option value="fedex">FedEx</option>
                        <option value="dhl">DHL</option>
                        <option value="ups">UPS</option>
                        <option value="aramex">Aramex</option>
                    </select>

                    <!-- إدخال رقم التتبع -->
                    <input type="text" id="tracking-number" class="form-control"
                        placeholder="{{ __('messages.enter_tracking_number') }}" required>

                    <!-- زر البحث -->
                    <button type="submit" class="btn btn-primary justify-content-center">
                        <i class="fas fa-search"></i> {{ __('messages.search') }}
                    </button>
                </form>

                <!-- رسالة التحميل -->
                <div id="loading" class="text-center mt-3" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">{{ __('messages.loading') }}</span>
                    </div>
                    <p class="mt-2">{{ __('messages.searching') }}</p>
                </div>

                <!-- رسالة الخطأ -->
                <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>

                <!-- أسماء الشركات العالمية -->
                <div class="companies mt-4" data-aos="fade-up" data-aos-delay="300">
                    <h6 class="text-white mb-3">{{ __('messages.supported_companies') }}</h6>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="company-item">
                            <img src="https://cdn-icons-png.flaticon.com/128/5977/5977583.png" alt="FedEx"
                                class="company-logo">
                            <span>FedEx</span>
                        </div>
                        <div class="company-item">
                            <img src="https://cdn-icons-png.flaticon.com/128/5977/5977580.png" alt="DHL"
                                class="company-logo">
                            <span>DHL</span>
                        </div>
                        <div class="company-item">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.explicit.bing.net%2Fth%3Fid%3DOIP.tTfM3fLSkTp94QDMxb3xwQHaIr%26pid%3DApi&f=1"
                                alt="UPS" class="company-logo">
                            <span>UPS</span>
                        </div>
                        <div class="company-item">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.p4mwWAdJFW9RiBFq-OSCPgHaHa%26pid%3DApi&f=1"
                                alt="Aramex" class="company-logo">
                            <span>Aramex</span>
                        </div>
                    </div>
                </div>

                <!-- الإحصائيات -->
                <div class="row gy-4 mt-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span>+1000</span>
                            <p>{{ __('messages.clients') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span>+50K</span>
                            <p>{{ __('messages.shipments') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span>+10</span>
                            <p>{{ __('messages.workers') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- صورة الهيرو -->
            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="{{ $web?->hero_image ? asset('storage/' . $web?->hero_image) : asset('assets/img/logo.png') }}"
                    class="img-fluid mb-3 mb-lg-0" alt="">
            </div>
        </div>
    </div>
</section><!-- /Hero Section -->

<script>
    document.getElementById('company').addEventListener('change', function() {
        if (this.value === "") {
            this.setCustomValidity("Please select a company from the list.");
        } else {
            this.setCustomValidity("");
        }
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        var companySelect = document.getElementById('company');
        if (companySelect.value === "") {
            companySelect.setCustomValidity("Please select a company from the list.");
        } else {
            companySelect.setCustomValidity("");
        }
    });
    document.getElementById('tracking-form').addEventListener('submit', function(e) {
        e.preventDefault(); // منع إعادة تحميل الصفحة

        const company = document.getElementById('company').value;
        const trackingNumber = document.getElementById('tracking-number').value;
        const loading = document.getElementById('loading');
        const errorMessage = document.getElementById('error-message');

        // إظهار رسالة التحميل
        loading.style.display = 'block';
        errorMessage.style.display = 'none';

        // محاكاة البحث (يمكن استبدالها بطلب AJAX حقيقي)
        setTimeout(() => {
            loading.style.display = 'none';

            // إذا فشل البحث
            if (!trackingNumber || trackingNumber.length < 5) {
                errorMessage.textContent = 'Invalid tracking number. Please try again.';
                errorMessage.style.display = 'block';
            } else {
                // روابط البحث لكل شركة
                const companyUrls = {
                    dhl: `https://www.dhl.com/us-en/home/tracking/tracking-parcel.html?submit=1&tracking-id=${trackingNumber}`,
                    ups: `https://www.ups.com/track?tracknum=${trackingNumber}`,
                    fedex: `https://www.fedex.com/fedextrack/?tracknumbers=${trackingNumber}`,
                    aramex: `https://www.aramex.com/track/results?track=${trackingNumber}`
                };

                // توجيه المستخدم إلى رابط الشركة المختارة
                if (companyUrls[company]) {
                    window.location.href = companyUrls[company];
                } else {
                    // إذا لم يتم اختيار شركة، يتم توجيه المستخدم إلى رابط عام
                    window.location.href = `https://www.track-trace.com/`;
                }
            }
        }, 2000); // محاكاة تأخير البحث لمدة 2 ثانية
    });
</script>
<style>
    .company-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 12px;
        border-radius: 8px;
        transition: transform 0.3s;
    }

    .company-item:hover {
        transform: translateY(-5px);
    }

    .company-logo {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    .company-item span {
        font-size: 0.9rem;
        color: white;
    }

    .form-search .btn {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .spinner-border {
        width: 2rem;
        height: 2rem;
    }

    .form-select {
        width: 150px;
        /* تحديد عرض قائمة الشركات */
    }
</style>
