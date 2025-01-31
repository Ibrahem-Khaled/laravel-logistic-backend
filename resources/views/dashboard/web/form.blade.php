<form action="{{ $action }}" method="POST" enctype="multipart/form-data" onsubmit="return convertFeaturesToJson()">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif
    <div class="row">
        <!-- عنوان الموقع -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="site_title">عنوان الموقع</label>
                <input type="text" name="site_title" class="form-control" placeholder="أدخل عنوان الموقع"
                    value="{{ $webEn ? $webEn->site_title : '' }}">
            </div>
        </div>

        <!-- وصف الموقع -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="site_description">وصف الموقع</label>
                <input type="text" name="site_description" class="form-control" placeholder="أدخل وصف الموقع"
                    value="{{ $webEn ? $webEn->site_description : '' }}">
            </div>
        </div>

        <!-- صورة الموقع -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="site_image">صورة الموقع</label>
                <input type="file" name="site_image" class="form-control">
            </div>
        </div>

        <!-- الكلمات المفتاحية -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="keywords">الكلمات المفتاحية</label>
                <input type="text" name="keywords" class="form-control" placeholder="أدخل الكلمات المفتاحية"
                    value="{{ $webEn ? $webEn->keywords : '' }}">
            </div>
        </div>

        <!-- عنوان البطل -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="hero_title">عنوان البطل</label>
                <input type="text" name="hero_title" class="form-control" placeholder="أدخل عنوان البطل"
                    value="{{ $webEn ? $webEn->hero_title : '' }}">
            </div>
        </div>

        <!-- وصف البطل -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="hero_description">وصف البطل</label>
                <input type="text" name="hero_description" class="form-control" placeholder="أدخل وصف البطل"
                    value="{{ $webEn ? $webEn->hero_description : '' }}">
            </div>
        </div>

        <!-- صورة البطل -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="hero_image">صورة البطل</label>
                <input type="file" name="hero_image" class="form-control">
            </div>
        </div>

        <!-- عنوان القسم "نبذة عنا" -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="about_title">عنوان القسم "نبذة عنا"</label>
                <input type="text" name="about_title" class="form-control" placeholder="أدخل عنوان القسم"
                    value="{{ $webEn ? $webEn->about_title : '' }}">
            </div>
        </div>

        <!-- وصف القسم "نبذة عنا" -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="about_description">وصف القسم "نبذة عنا"</label>
                <input type="text" name="about_description" class="form-control" placeholder="أدخل وصف القسم"
                    value="{{ $webEn ? $webEn->about_description : '' }}">
            </div>
        </div>

        <!-- صورة القسم "نبذة عنا" -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="about_image">صورة القسم "نبذة عنا"</label>
                <input type="file" name="about_image" class="form-control">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>ميزات القسم "نبذة عنا"</label>
                <div id="features-container">
                    @if ($webEn && $webEn->about_features)
                        @foreach (json_decode($webEn->about_features, true) as $index => $feature)
                            <div class="feature-input mb-2">
                                <input type="text" class="form-control mb-1" placeholder="عنوان الميزة"
                                    value="{{ $feature['title'] ?? '' }}">
                                <input type="text" class="form-control" placeholder="وصف الميزة"
                                    value="{{ $feature['description'] ?? '' }}">
                                @if ($index > 0)
                                    <button type="button" class="btn btn-danger btn-sm mt-1"
                                        onclick="removeFeatureInput(this)">حذف</button>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="feature-input mb-2">
                            <input type="text" class="form-control mb-1" placeholder="عنوان الميزة">
                            <input type="text" class="form-control" placeholder="وصف الميزة">
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" onclick="addFeatureInput()">إضافة
                    ميزة</button>
                <textarea name="about_features" id="about_features" class="form-control d-none"></textarea>
            </div>
        </div>
        <!-- عنوان القسم "الموقع" -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="location_title">عنوان القسم "الموقع"</label>
                <input type="text" name="location_title" class="form-control" placeholder="أدخل عنوان القسم"
                    value="{{ $webEn ? $webEn->location_title : '' }}">
            </div>
        </div>

        <!-- وصف القسم "الموقع" -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="location_description">وصف القسم "الموقع"</label>
                <input type="text" name="location_description" class="form-control" placeholder="أدخل وصف القسم"
                    value="{{ $webEn ? $webEn->location_description : '' }}">
            </div>
        </div>

        <!-- صورة القسم "الموقع" -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="location_image">صورة القسم "الموقع"</label>
                <input type="file" name="location_image" class="form-control">
            </div>
        </div>
    </div>

    <!-- زر الحفظ -->
    <button type="submit" class="btn btn-success">حفظ</button>
</form>


<script>
    function addFeatureInput() {
        const container = document.getElementById('features-container');
        const newInput = document.createElement('div');
        newInput.classList.add('feature-input', 'mb-2');
        newInput.innerHTML = `
        <input type="text" class="form-control mb-1" placeholder="عنوان الميزة">
        <input type="text" class="form-control" placeholder="وصف الميزة">
        <button type="button" class="btn btn-danger btn-sm mt-1" onclick="removeFeatureInput(this)">حذف</button>
    `;
        container.appendChild(newInput);
    }

    function removeFeatureInput(button) {
        button.closest('.feature-input').remove();
    }

    function convertFeaturesToJson() {
        const featureInputs = document.querySelectorAll('#features-container .feature-input');
        const features = [];

        featureInputs.forEach(inputDiv => {
            const title = inputDiv.children[0].value.trim();
            const description = inputDiv.children[1].value.trim();

            if (title || description) {
                features.push({
                    title: title,
                    description: description
                });
            }
        });

        document.getElementById('about_features').value = JSON.stringify(features);
        return true;
    }
</script>
