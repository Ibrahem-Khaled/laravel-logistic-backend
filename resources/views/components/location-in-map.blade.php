<section id="location-in-map" class="location-in-map">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>{{ $web->location_title ?? '' }}</h2>
                <p>
                    {{ $web->location_description ?? '' }}
                </p>
            </div>
            <div class="col-lg-6">
                <div class="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3382.123456789012!2d35.910000000000004!3d31.950000000000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b5f816714295d%3A0xc86fcf956eb2abdb!2sKafafi%20Express%2C%20K.%20Hussein%20St.%207%D8%8C%20Amman!5e0!3m2!1sen!2sjo!4v1631234567890!5m2!1sen!2sjo"
                        width="100%" height="384" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
