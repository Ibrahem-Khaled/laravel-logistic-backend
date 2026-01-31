@extends('layouts.web.web')

@section('title', __('messages.shipping_rates'))
@section('content')
<!-- Shipping Quote Calculator Section -->
<section id="shipping-quote" class="shipping-quote section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>{{ __('messages.shipping_quote_title') }}<br></span>
        <h2>{{ __('messages.shipping_quote_title') }}</h2>
        <p>{{ __('messages.shipping_quote_subtitle') }}</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <form id="shipping-quote-form">
                            <div class="row gy-4">
                                <!-- From Country -->
                                <div class="col-md-6">
                                    <label for="origin_country_id" class="form-label">
                                        <i class="bi bi-geo-alt-fill me-2"></i>{{ __('messages.from') }}
                                    </label>
                                    <select class="form-select" id="origin_country_id" name="origin_country_id" required>
                                        <option value="{{ $jordan->id ?? '' }}" selected>{{ app()->getLocale() == 'ar' ? ($jordan->name_ar ?? 'الأردن') : ($jordan->name_en ?? 'Jordan') }}</option>
                                    </select>
                                </div>

                                <!-- To Country -->
                                <div class="col-md-6">
                                    <label for="destination_country_id" class="form-label">
                                        <i class="bi bi-geo-alt me-2"></i>{{ __('messages.to') }}
                                    </label>
                                    <select class="form-select" id="destination_country_id" name="destination_country_id" required>
                                        <option value="" disabled selected>{{ __('messages.select_country') }}</option>
                                    </select>
                                </div>

                                <!-- Shipment Type -->
                                <div class="col-md-6">
                                    <label for="shipment_type" class="form-label">
                                        <i class="bi bi-box-seam me-2"></i>{{ __('messages.shipment_type') }}
                                    </label>
                                    <select class="form-select" id="shipment_type" name="shipment_type" required>
                                        <option value="parcel" selected>{{ __('messages.parcel') }}</option>
                                        <option value="documents">{{ __('messages.documents') }}</option>
                                    </select>
                                </div>

                                <!-- Weight Unit -->
                                <div class="col-md-6">
                                    <label for="weight_unit" class="form-label">
                                        <i class="bi bi-rulers me-2"></i>{{ __('messages.weight_unit') }}
                                    </label>
                                    <select class="form-select" id="weight_unit" name="weight_unit" required>
                                        <option value="kg" selected>{{ __('messages.weight_kg') }}</option>
                                        <option value="lb">{{ __('messages.weight_lb') }}</option>
                                    </select>
                                </div>

                                <!-- Weight per Unit -->
                                <div class="col-md-6">
                                    <label for="weight_per_unit" class="form-label">
                                        <i class="bi bi-speedometer2 me-2"></i>{{ __('messages.weight_per_unit') }}
                                    </label>
                                    <div class="input-group shipping-input-group">
                                        <input type="number" class="form-control" id="weight_per_unit" name="weight_per_unit"
                                            step="0.01" min="0.01" placeholder="0.00" required>
                                        <span class="input-group-text" id="weight-unit-display">Kg</span>
                                    </div>
                                </div>

                                <!-- Units Count -->
                                <div class="col-md-6">
                                    <label for="units_count" class="form-label">
                                        <i class="bi bi-123 me-2"></i>{{ __('messages.units_count') }}
                                    </label>
                                    <input type="number" class="form-control" id="units_count"
                                        name="units_count" min="1" value="1" required>
                                </div>

                                <!-- Calculate Button -->
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-calculate w-100 py-3" id="calculate-btn">
                                        <i class="bi bi-calculator me-2"></i>
                                        {{ __('messages.calculate_price') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Loading Spinner -->
                        <div id="quote-loading" class="text-center mt-4" style="display: none;">
                            <div class="spinner-border text-danger" role="status" style="width: 3rem; height: 3rem;">
                                <span class="visually-hidden">{{ __('messages.calculating') }}</span>
                            </div>
                            <p class="mt-3 text-muted">{{ __('messages.calculating_shipping') }}</p>
                        </div>

                        <!-- Result Display -->
                        <div id="quote-result" class="mt-4" style="display: none;">
                            <div class="card border-0 shadow-sm result-card">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h4 class="text-success mb-3">
                                                <i class="bi bi-check-circle-fill me-2"></i>
                                                {{ __('messages.shipping_price') }}
                                            </h4>
                                            <div id="quote-breakdown" class="breakdown-list"></div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="price-display">
                                                <div class="price-value" id="quote-price">0.00</div>
                                                <div class="price-currency" id="quote-currency">JOD</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Display -->
                        <div id="quote-error" class="alert alert-danger mt-4 border-0 shadow-sm" style="display: none;">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <span id="quote-error-message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Shipping Quote Calculator Section -->

<style>
/* Shipping Quote Section Styles */
.shipping-quote {
    padding: 60px 0;
    background-color: var(--background-color);
}

.shipping-quote .card {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.shipping-quote .card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.shipping-quote .form-label {
    color: var(--heading-color);
    font-weight: 500;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.shipping-quote .form-label i {
    color: var(--accent-color);
}

.shipping-quote .form-select,
.shipping-quote .form-control {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    padding: 12px 15px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    height: 48px;
    line-height: 1.5;
    color: var(--default-color);
    background-color: #ffffff;
    width: 100%;
    font-family: var(--default-font);
}

.shipping-quote .form-control::placeholder {
    color: #adb5bd;
    opacity: 1;
}

.shipping-quote .form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px 12px;
    padding-right: 40px;
    cursor: pointer;
}

.shipping-quote .form-select:hover {
    border-color: #c0c0c0;
}

.shipping-quote .form-select:focus,
.shipping-quote .form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.2rem rgba(188, 21, 35, 0.15);
    outline: none;
}

.shipping-quote .form-select option {
    padding: 10px 15px;
    font-size: 0.95rem;
}

.shipping-quote .input-group,
.shipping-quote .shipping-input-group {
    display: flex;
    align-items: stretch;
    width: 100%;
    flex-wrap: nowrap;
    direction: ltr;
}

.shipping-quote .input-group .form-control,
.shipping-quote .shipping-input-group .form-control {
    height: 48px;
    border-radius: 6px 0 0 6px;
    border-right: none;
    flex: 1 1 auto;
    min-width: 0;
}

.shipping-quote .input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-left: none;
    border-radius: 0 6px 6px 0;
    color: var(--heading-color);
    font-weight: 500;
    padding: 12px 15px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 60px;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.shipping-quote .input-group:focus-within .input-group-text {
    border-color: var(--accent-color);
}

.shipping-quote .input-group:focus-within .form-control {
    border-color: var(--accent-color);
}

/* Calculate Button - Red Color */
.btn-calculate {
    background-color: var(--accent-color);
    border-color: var(--accent-color);
    color: #ffffff;
    font-weight: 600;
    font-size: 1.1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(188, 21, 35, 0.3);
}

.btn-calculate:hover {
    background-color: #9a111c;
    border-color: #9a111c;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(188, 21, 35, 0.4);
}

.btn-calculate:active,
.btn-calculate:focus {
    background-color: #9a111c;
    border-color: #9a111c;
    color: #ffffff;
    box-shadow: 0 4px 15px rgba(188, 21, 35, 0.3);
}

.btn-calculate:disabled {
    background-color: var(--accent-color);
    border-color: var(--accent-color);
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Result Card */
.result-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-left: 4px solid #28a745 !important;
}

.result-card .text-success {
    color: #28a745 !important;
}

/* Breakdown List */
.breakdown-list {
    font-size: 0.95rem;
}

.breakdown-list ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.breakdown-list li {
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
}

.breakdown-list li:last-child {
    border-bottom: none;
}

.breakdown-list li i {
    color: var(--accent-color);
    margin-left: 8px;
    font-size: 1rem;
}

.breakdown-list strong {
    color: var(--heading-color);
    margin-left: 5px;
}

/* Price Display */
.price-display {
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 10px;
    border: 2px solid #e9ecef;
}

.price-value {
    font-size: 3rem;
    font-weight: 700;
    color: var(--accent-color);
    line-height: 1;
    margin-bottom: 5px;
    font-family: var(--heading-font);
}

.price-currency {
    font-size: 1.1rem;
    color: var(--default-color);
    font-weight: 500;
    opacity: 0.7;
}

/* Loading Spinner */
#quote-loading .spinner-border {
    border-width: 3px;
    border-color: var(--accent-color);
    border-right-color: transparent;
}

/* Error Alert */
#quote-error {
    background-color: #f8d7da;
    color: #721c24;
    border-radius: 8px;
}

#quote-error i {
    color: #dc3545;
}

/* Ensure all form elements have same height */
.shipping-quote .form-select,
.shipping-quote .form-control,
.shipping-quote .input-group-text {
    box-sizing: border-box;
}

/* Responsive */
@media (max-width: 768px) {
    .shipping-quote {
        padding: 40px 0;
    }

    .shipping-quote .form-select,
    .shipping-quote .form-control {
        height: 46px;
        padding: 10px 12px;
        font-size: 0.9rem;
    }

    .shipping-quote .input-group-text {
        height: 46px;
        padding: 10px 12px;
        font-size: 0.9rem;
    }

    .price-value {
        font-size: 2.2rem;
    }

    .breakdown-list {
        font-size: 0.85rem;
    }

    .btn-calculate {
        font-size: 1rem;
        padding: 12px !important;
    }
}

@media (max-width: 576px) {
    .shipping-quote .card-body {
        padding: 20px !important;
    }

    .price-value {
        font-size: 1.8rem;
    }
}
</style>

@php
    $shippingQuoteTranslations = [
        'calculating' => __('messages.calculating'),
        'calculate_price' => __('messages.calculate_price'),
        'from_label' => __('messages.from_label'),
        'to_label' => __('messages.to_label'),
        'zone' => __('messages.zone'),
        'shipment_type_label' => __('messages.shipment_type_label'),
        'parcel' => __('messages.parcel'),
        'documents' => __('messages.documents'),
        'total_weight' => __('messages.total_weight'),
        'pricing_type' => __('messages.pricing_type'),
        'flat_rate' => __('messages.flat_rate'),
        'per_kg' => __('messages.per_kg'),
        'error_calculating' => __('messages.error_calculating'),
        'error_connection' => __('messages.error_connection'),
        'login_required_for_quote' => __('messages.login_required_for_quote'),
    ];
@endphp
<script>
window.shippingQuoteTranslations = @json($shippingQuoteTranslations);
window.shippingQuoteLocale = @json(app()->getLocale());
window.shippingQuoteLoginUrl = @json(route('login'));
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const t = window.shippingQuoteTranslations;
    const locale = window.shippingQuoteLocale || 'ar';
    const form = document.getElementById('shipping-quote-form');
    const originSelect = document.getElementById('origin_country_id');
    const destinationSelect = document.getElementById('destination_country_id');
    const weightUnitSelect = document.getElementById('weight_unit');
    const weightUnitDisplay = document.getElementById('weight-unit-display');
    const calculateBtn = document.getElementById('calculate-btn');
    const loadingDiv = document.getElementById('quote-loading');
    const resultDiv = document.getElementById('quote-result');
    const errorDiv = document.getElementById('quote-error');
    const quotePrice = document.getElementById('quote-price');
    const quoteCurrency = document.getElementById('quote-currency');
    const quoteBreakdown = document.getElementById('quote-breakdown');

    function countryName(c) {
        return locale === 'ar' ? (c.name_ar || c.name_en) : (c.name_en || c.name_ar);
    }

    // Load countries on page load
    fetch('{{ route("shipping.countries") }}')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.countries) {
                data.countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.id;
                    option.textContent = countryName(country);
                    destinationSelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error loading countries:', error);
        });

    // Update weight unit display
    weightUnitSelect.addEventListener('change', function() {
        weightUnitDisplay.textContent = this.value === 'kg' ? 'Kg' : 'LB';
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Hide previous results
        resultDiv.style.display = 'none';
        errorDiv.style.display = 'none';
        loadingDiv.style.display = 'block';
        calculateBtn.disabled = true;
        calculateBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>' + t.calculating;

        const formData = new FormData(form);
        const data = {
            origin_country_id: parseInt(formData.get('origin_country_id')),
            destination_country_id: parseInt(formData.get('destination_country_id')),
            shipment_type: formData.get('shipment_type'),
            weight_per_unit: parseFloat(formData.get('weight_per_unit')),
            units_count: parseInt(formData.get('units_count')),
            weight_unit: formData.get('weight_unit'),
        };

        fetch('{{ route("shipping.quote") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (response.status === 401) {
                window.location.href = (window.shippingQuoteLoginUrl || '{{ route("login") }}') + '?intended=' + encodeURIComponent(window.location.href);
                return null;
            }
            return response.json();
        })
        .then(data => {
            loadingDiv.style.display = 'none';
            calculateBtn.disabled = false;
            calculateBtn.innerHTML = '<i class="bi bi-calculator me-2"></i>' + t.calculate_price;

            if (!data) return;

            if (data.success) {
                quotePrice.textContent = data.price.toFixed(2);
                quoteCurrency.textContent = data.currency || 'JOD';

                const breakdown = data.breakdown || {};
                const shipmentTypeLabel = breakdown.shipment_type === 'parcel' ? t.parcel : t.documents;
                const pricingTypeLabel = breakdown.pricing_type === 'flat' ? t.flat_rate : t.per_kg;

                let breakdownHTML = '<ul>';
                breakdownHTML += '<li><i class="bi bi-arrow-right-circle"></i><strong>' + t.from_label + '</strong> ' + (breakdown.origin_country || '') + '</li>';
                breakdownHTML += '<li><i class="bi bi-arrow-left-circle"></i><strong>' + t.to_label + '</strong> ' + (breakdown.destination_country || '') + '</li>';
                breakdownHTML += '<li><i class="bi bi-map"></i><strong>' + t.zone + ':</strong> ' + (breakdown.zone || '') + '</li>';
                breakdownHTML += '<li><i class="bi bi-box"></i><strong>' + t.shipment_type_label + '</strong> ' + shipmentTypeLabel + '</li>';
                breakdownHTML += '<li><i class="bi bi-speedometer"></i><strong>' + t.total_weight + ':</strong> ' + (breakdown.total_weight || '') + '</li>';
                breakdownHTML += '<li><i class="bi bi-cash-stack"></i><strong>' + t.pricing_type + ':</strong> ' + pricingTypeLabel + ' - ' + (breakdown.rate_applied || '') + '</li>';
                breakdownHTML += '</ul>';

                quoteBreakdown.innerHTML = breakdownHTML;
                resultDiv.style.display = 'block';

                setTimeout(() => {
                    resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            } else {
                document.getElementById('quote-error-message').textContent = data.message || t.error_calculating;
                errorDiv.style.display = 'block';
            }
        })
        .catch(error => {
            loadingDiv.style.display = 'none';
            calculateBtn.disabled = false;
            calculateBtn.innerHTML = '<i class="bi bi-calculator me-2"></i>' + t.calculate_price;
            document.getElementById('quote-error-message').textContent = t.error_connection;
            errorDiv.style.display = 'block';
            console.error('Error:', error);
        });
    });
});
</script>
@endsection
