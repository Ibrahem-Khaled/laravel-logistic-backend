<?php

namespace Database\Seeders;

use App\Models\WebAr;
use App\Models\WebEn;
use Illuminate\Database\Seeder;

class WebContentSeeder extends Seeder
{
    /**
     * Seed web_ens and web_ars with dummy data for dashboard preview.
     */
    public function run(): void
    {
        $aboutFeaturesEn = json_encode([
            ['title' => 'Fast Delivery', 'description' => 'We ensure your shipments reach on time with our express network.'],
            ['title' => 'Global Coverage', 'description' => 'Ship to and from major countries with reliable tracking.'],
            ['title' => 'Secure Handling', 'description' => 'Your cargo is handled with care and full insurance options.'],
        ]);

        $aboutFeaturesAr = json_encode([
            ['title' => 'توصيل سريع', 'description' => 'نضمن وصول شحناتك في الوقت المحدد عبر شبكتنا السريعة.'],
            ['title' => 'تغطية عالمية', 'description' => 'الشحن من وإلى دول رئيسية مع تتبع موثوق.'],
            ['title' => 'معالجة آمنة', 'description' => 'البضائع تُعالج بعناية مع خيارات تأمين كاملة.'],
        ]);

        $dataEn = [
            'site_title' => 'Logistics Company - Your Trusted Shipping Partner',
            'site_description' => 'Professional logistics and shipping solutions for businesses and individuals.',
            'site_image' => null,
            'keywords' => 'shipping, logistics, freight, delivery, courier, Jordan',
            'hero_title' => 'Track Your Shipment Easily',
            'hero_description' => 'Enter your tracking number and select a company to track your shipment status in real-time.',
            'hero_image' => null,
            'about_title' => 'About Us - Who We Are',
            'about_description' => 'We are a leading logistics company providing reliable shipping and storage solutions. Our team works around the clock to deliver your goods safely and on time.',
            'about_image' => null,
            'about_features' => $aboutFeaturesEn,
            'location_title' => 'Our Location - Get in Touch',
            'location_description' => 'Visit us at our headquarters in Amman. We are here to assist you with all your shipping needs.',
            'location_image' => null,
        ];

        $webEn = WebEn::first();
        $webEn ? $webEn->update($dataEn) : WebEn::create($dataEn);

        $dataAr = [
            'site_title' => 'شركة لوجستية - شريكك الموثوق في الشحن',
            'site_description' => 'حلول لوجستية وشحن احترافية للأفراد والشركات.',
            'site_image' => null,
            'keywords' => 'شحن، لوجستيات، بضائع، توصيل، أردن',
            'hero_title' => 'تتبع شحنتك بسهولة',
            'hero_description' => 'أدخل رقم التتبع واختر شركة الشحن لمتابعة حالة شحنتك في الوقت الحقيقي.',
            'hero_image' => null,
            'about_title' => 'من نحن',
            'about_description' => 'نحن شركة لوجستية رائدة نقدم حلول شحن وتخزين موثوقة. يعمل فريقنا على مدار الساعة لتوصيل بضائعك بأمان وفي الوقت المحدد.',
            'about_image' => null,
            'about_features' => $aboutFeaturesAr,
            'location_title' => 'موقعنا - تواصل معنا',
            'location_description' => 'زرنا في مقرنا الرئيسي في عمان. نحن هنا لمساعدتك في كل احتياجاتك الشحن.',
            'location_image' => null,
        ];

        $webAr = WebAr::first();
        $webAr ? $webAr->update($dataAr) : WebAr::create($dataAr);
    }
}
