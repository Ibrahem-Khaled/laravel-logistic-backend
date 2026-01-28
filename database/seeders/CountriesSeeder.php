<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            // الأردن (Origin)
            ['name_en' => 'Jordan', 'name_ar' => 'الأردن', 'iso2' => 'JO', 'is_active' => true],

            // Zone 1
            ['name_en' => 'Qatar', 'name_ar' => 'قطر', 'iso2' => 'QA', 'is_active' => true],
            ['name_en' => 'Saudi Arabia', 'name_ar' => 'المملكة العربية السعودية', 'iso2' => 'SA', 'is_active' => true],
            ['name_en' => 'Bahrain', 'name_ar' => 'البحرين', 'iso2' => 'BH', 'is_active' => true],
            ['name_en' => 'Kuwait', 'name_ar' => 'الكويت', 'iso2' => 'KW', 'is_active' => true],
            ['name_en' => 'United Arab Emirates', 'name_ar' => 'الإمارات العربية المتحدة', 'iso2' => 'AE', 'is_active' => true],
            ['name_en' => 'Oman', 'name_ar' => 'عمان', 'iso2' => 'OM', 'is_active' => true],

            // Zone 2
            ['name_en' => 'Finland', 'name_ar' => 'فنلندا', 'iso2' => 'FI', 'is_active' => true],
            ['name_en' => 'France', 'name_ar' => 'فرنسا', 'iso2' => 'FR', 'is_active' => true],
            ['name_en' => 'Germany', 'name_ar' => 'ألمانيا', 'iso2' => 'DE', 'is_active' => true],
            ['name_en' => 'Greece', 'name_ar' => 'اليونان', 'iso2' => 'GR', 'is_active' => true],
            ['name_en' => 'Hungary', 'name_ar' => 'المجر', 'iso2' => 'HU', 'is_active' => true],
            ['name_en' => 'India', 'name_ar' => 'الهند', 'iso2' => 'IN', 'is_active' => true],
            ['name_en' => 'Ireland', 'name_ar' => 'أيرلندا', 'iso2' => 'IE', 'is_active' => true],
            ['name_en' => 'Italy', 'name_ar' => 'إيطاليا', 'iso2' => 'IT', 'is_active' => true],
            ['name_en' => 'Netherlands', 'name_ar' => 'هولندا', 'iso2' => 'NL', 'is_active' => true],
            ['name_en' => 'Norway', 'name_ar' => 'النرويج', 'iso2' => 'NO', 'is_active' => true],
            ['name_en' => 'Poland', 'name_ar' => 'بولندا', 'iso2' => 'PL', 'is_active' => true],
            ['name_en' => 'Portugal', 'name_ar' => 'البرتغال', 'iso2' => 'PT', 'is_active' => true],
            ['name_en' => 'Romania', 'name_ar' => 'رومانيا', 'iso2' => 'RO', 'is_active' => true],
            ['name_en' => 'Spain', 'name_ar' => 'إسبانيا', 'iso2' => 'ES', 'is_active' => true],
            ['name_en' => 'Sweden', 'name_ar' => 'السويد', 'iso2' => 'SE', 'is_active' => true],
            ['name_en' => 'Switzerland', 'name_ar' => 'سويسرا', 'iso2' => 'CH', 'is_active' => true],
            ['name_en' => 'Taiwan', 'name_ar' => 'تايوان', 'iso2' => 'TW', 'is_active' => true],
            ['name_en' => 'United Kingdom', 'name_ar' => 'المملكة المتحدة', 'iso2' => 'GB', 'is_active' => true],
            ['name_en' => 'Bangladesh', 'name_ar' => 'بنغلاديش', 'iso2' => 'BD', 'is_active' => true],
            ['name_en' => 'Czech Republic', 'name_ar' => 'جمهورية التشيك', 'iso2' => 'CZ', 'is_active' => true],
            ['name_en' => 'Denmark', 'name_ar' => 'الدنمارك', 'iso2' => 'DK', 'is_active' => true],
            ['name_en' => 'Egypt', 'name_ar' => 'مصر', 'iso2' => 'EG', 'is_active' => true],
            ['name_en' => 'China', 'name_ar' => 'الصين', 'iso2' => 'CN', 'is_active' => true],
            ['name_en' => 'Austria', 'name_ar' => 'النمسا', 'iso2' => 'AT', 'is_active' => true],
            ['name_en' => 'Belgium', 'name_ar' => 'بلجيكا', 'iso2' => 'BE', 'is_active' => true],
            ['name_en' => 'Lebanon', 'name_ar' => 'لبنان', 'iso2' => 'LB', 'is_active' => true],
            ['name_en' => 'Sri Lanka', 'name_ar' => 'سريلانكا', 'iso2' => 'LK', 'is_active' => true],
            ['name_en' => 'Hong Kong', 'name_ar' => 'هونغ كونغ', 'iso2' => 'HK', 'is_active' => true],
            ['name_en' => 'Pakistan', 'name_ar' => 'باكستان', 'iso2' => 'PK', 'is_active' => true],

            // Zone 3
            ['name_en' => 'Afghanistan', 'name_ar' => 'أفغانستان', 'iso2' => 'AF', 'is_active' => true],
            ['name_en' => 'Indonesia', 'name_ar' => 'إندونيسيا', 'iso2' => 'ID', 'is_active' => true],
            ['name_en' => 'Singapore', 'name_ar' => 'سنغافورة', 'iso2' => 'SG', 'is_active' => true],
            ['name_en' => 'Japan', 'name_ar' => 'اليابان', 'iso2' => 'JP', 'is_active' => true],
            ['name_en' => 'South Korea', 'name_ar' => 'كوريا الجنوبية', 'iso2' => 'KR', 'is_active' => true],
            ['name_en' => 'Kenya', 'name_ar' => 'كينيا', 'iso2' => 'KE', 'is_active' => true],
            ['name_en' => 'Thailand', 'name_ar' => 'تايلاند', 'iso2' => 'TH', 'is_active' => true],
            ['name_en' => 'Vietnam', 'name_ar' => 'فيتنام', 'iso2' => 'VN', 'is_active' => true],
            ['name_en' => 'Malaysia', 'name_ar' => 'ماليزيا', 'iso2' => 'MY', 'is_active' => true],
            ['name_en' => 'Canada', 'name_ar' => 'كندا', 'iso2' => 'CA', 'is_active' => true],

            // Zone 4
            ['name_en' => 'Australia', 'name_ar' => 'أستراليا', 'iso2' => 'AU', 'is_active' => true],
            ['name_en' => 'Iceland', 'name_ar' => 'آيسلندا', 'iso2' => 'IS', 'is_active' => true],
            ['name_en' => 'Brazil', 'name_ar' => 'البرازيل', 'iso2' => 'BR', 'is_active' => true],
            ['name_en' => 'United States', 'name_ar' => 'الولايات المتحدة', 'iso2' => 'US', 'is_active' => true],
            ['name_en' => 'South Africa', 'name_ar' => 'جنوب أفريقيا', 'iso2' => 'ZA', 'is_active' => true],
            ['name_en' => 'Luxembourg', 'name_ar' => 'لوكسمبورغ', 'iso2' => 'LU', 'is_active' => true],
            ['name_en' => 'Cyprus', 'name_ar' => 'قبرص', 'iso2' => 'CY', 'is_active' => true],

            // Zone 5
            ['name_en' => 'Albania', 'name_ar' => 'ألبانيا', 'iso2' => 'AL', 'is_active' => true],
            ['name_en' => 'Algeria', 'name_ar' => 'الجزائر', 'iso2' => 'DZ', 'is_active' => true],
            ['name_en' => 'Angola', 'name_ar' => 'أنغولا', 'iso2' => 'AO', 'is_active' => true],
            ['name_en' => 'Argentina', 'name_ar' => 'الأرجنتين', 'iso2' => 'AR', 'is_active' => true],
            ['name_en' => 'Armenia', 'name_ar' => 'أرمينيا', 'iso2' => 'AM', 'is_active' => true],
            ['name_en' => 'Belarus', 'name_ar' => 'بيلاروسيا', 'iso2' => 'BY', 'is_active' => true],
            ['name_en' => 'Benin', 'name_ar' => 'بنين', 'iso2' => 'BJ', 'is_active' => true],
            ['name_en' => 'Bolivia', 'name_ar' => 'بوليفيا', 'iso2' => 'BO', 'is_active' => true],
            ['name_en' => 'Bulgaria', 'name_ar' => 'بلغاريا', 'iso2' => 'BG', 'is_active' => true],
            ['name_en' => 'Burkina Faso', 'name_ar' => 'بوركينا فاسو', 'iso2' => 'BF', 'is_active' => true],
            ['name_en' => 'Croatia', 'name_ar' => 'كرواتيا', 'iso2' => 'HR', 'is_active' => true],
            ['name_en' => 'Malta', 'name_ar' => 'مالطا', 'iso2' => 'MT', 'is_active' => true],
            ['name_en' => 'Morocco', 'name_ar' => 'المغرب', 'iso2' => 'MA', 'is_active' => true],
            ['name_en' => 'Tunisia', 'name_ar' => 'تونس', 'iso2' => 'TN', 'is_active' => true],
            ['name_en' => 'Turkey', 'name_ar' => 'تركيا', 'iso2' => 'TR', 'is_active' => true],
            ['name_en' => 'Ukraine', 'name_ar' => 'أوكرانيا', 'iso2' => 'UA', 'is_active' => true],
            ['name_en' => 'Iraq', 'name_ar' => 'العراق', 'iso2' => 'IQ', 'is_active' => true],
            ['name_en' => 'Estonia', 'name_ar' => 'إستونيا', 'iso2' => 'EE', 'is_active' => true],
            ['name_en' => 'Lithuania', 'name_ar' => 'ليتوانيا', 'iso2' => 'LT', 'is_active' => true],
            ['name_en' => 'Serbia', 'name_ar' => 'صربيا', 'iso2' => 'RS', 'is_active' => true],
            ['name_en' => 'Slovakia', 'name_ar' => 'سلوفاكيا', 'iso2' => 'SK', 'is_active' => true],
            ['name_en' => 'Slovenia', 'name_ar' => 'سلوفينيا', 'iso2' => 'SI', 'is_active' => true],
            ['name_en' => 'Mexico', 'name_ar' => 'المكسيك', 'iso2' => 'MX', 'is_active' => true],
            ['name_en' => 'San Marino', 'name_ar' => 'سان مارينو', 'iso2' => 'SM', 'is_active' => true],
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate(
                ['name_en' => $country['name_en']],
                $country
            );
        }
    }
}
