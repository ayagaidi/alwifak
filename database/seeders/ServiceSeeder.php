<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name_ar' => 'تصميم الهوية البصرية',
                'name_en' => 'Visual Identity Design',
                'description_ar' => 'نقدم خدمات تصميم شاملة للهوية البصرية تشمل الشعارات والألوان والخطوط المميزة لعلامتك التجارية',
                'description_en' => 'We provide comprehensive visual identity design services including logos, colors, and distinctive fonts for your brand',
            ],
            [
                'name_ar' => 'التسويق الرقمي',
                'name_en' => 'Digital Marketing',
                'description_ar' => 'استراتيجيات تسويقية متكاملة عبر وسائل التواصل الاجتماعي ومحركات البحث لزيادة الوعي بعلامتك التجارية',
                'description_en' => 'Integrated marketing strategies across social media and search engines to increase brand awareness',
            ],
            [
                'name_ar' => 'تصميم المواقع الإلكترونية',
                'name_en' => 'Website Design',
                'description_ar' => 'تصميم وتطوير مواقع إلكترونية احترافية ومتجاوبة تلبي احتياجات عملك وتعكس هويتك البصرية',
                'description_en' => 'Design and development of professional, responsive websites that meet your business needs and reflect your visual identity',
            ],
            [
                'name_ar' => 'إنتاج المحتوى',
                'name_en' => 'Content Production',
                'description_ar' => 'إنتاج محتوى إبداعي ومؤثر يتضمن النصوص والصور والفيديوهات لتعزيز تواجدك الرقمي',
                'description_en' => 'Production of creative and impactful content including text, images, and videos to enhance your digital presence',
            ],
            [
                'name_ar' => 'إدارة وسائل التواصل الاجتماعي',
                'name_en' => 'Social Media Management',
                'description_ar' => 'إدارة شاملة لحساباتك على وسائل التواصل الاجتماعي مع استراتيجية محتوى متكاملة وتحليلات أداء',
                'description_en' => 'Comprehensive management of your social media accounts with integrated content strategy and performance analytics',
            ],
            [
                'name_ar' => 'التصوير الفوتوغرافي',
                'name_en' => 'Photography',
                'description_ar' => 'خدمات تصوير فوتوغرافي احترافية للمنتجات والفعاليات والصور الشخصية والإعلانية',
                'description_en' => 'Professional photography services for products, events, personal photos, and advertising',
            ],
            [
                'name_ar' => 'إنتاج الفيديو',
                'name_en' => 'Video Production',
                'description_ar' => 'إنتاج فيديوهات إعلانية وترويجية وتعليمية بجودة عالية ومؤثرات بصرية متطورة',
                'description_en' => 'Production of advertising, promotional, and educational videos with high quality and advanced visual effects',
            ],
            [
                'name_ar' => 'التسويق بالمحتوى',
                'name_en' => 'Content Marketing',
                'description_ar' => 'استراتيجيات تسويقية تعتمد على إنتاج وتوزيع محتوى قيم يجذب ويحتفظ بالعملاء المحتملين',
                'description_en' => 'Marketing strategies based on producing and distributing valuable content that attracts and retains potential customers',
            ],
            [
                'name_ar' => 'تحسين محركات البحث (SEO)',
                'name_en' => 'Search Engine Optimization (SEO)',
                'description_ar' => 'تحسين موقعك الإلكتروني ليحتل مراتب متقدمة في نتائج محركات البحث وزيادة الزيارات العضوية',
                'description_en' => 'Optimize your website to rank higher in search engine results and increase organic traffic',
            ],
            [
                'name_ar' => 'الإعلانات المدفوعة',
                'name_en' => 'Paid Advertising',
                'description_ar' => 'إدارة حملات إعلانية مدفوعة على جوجل وفيسبوك وإنستغرام ومنصات أخرى للوصول للجمهور المستهدف',
                'description_en' => 'Management of paid advertising campaigns on Google, Facebook, Instagram, and other platforms to reach target audience',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
