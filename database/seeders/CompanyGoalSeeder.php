<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyGoal;

class CompanyGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyGoals = [
            [
                'title' => 'الريادة في السوق',
                'title_en' => 'Market Leadership',
                'description' => 'أن نكون الشركة الرائدة في مجال الدعاية والإعلان في المملكة العربية السعودية، وأن نصبح المرجع الأول للعملاء الباحثين عن خدمات إعلانية متميزة.',
                'description_en' => 'To be the leading company in advertising and publicity in Saudi Arabia, and to become the first reference for clients looking for distinctive advertising services.',
            ],
            [
                'title' => 'الابتكار والإبداع',
                'title_en' => 'Innovation and Creativity',
                'description' => 'تطوير حلول إعلانية مبتكرة وإبداعية تلبي احتياجات عملائنا وتتجاوز توقعاتهم، مع الحرص على مواكبة أحدث التقنيات والتوجهات العالمية.',
                'description_en' => 'Developing innovative and creative advertising solutions that meet our clients\' needs and exceed their expectations, while keeping up with the latest technologies and global trends.',
            ],
            [
                'title' => 'رضا العملاء',
                'title_en' => 'Customer Satisfaction',
                'description' => 'تحقيق أعلى مستويات رضا العملاء من خلال تقديم خدمات عالية الجودة ودعم فني مستمر، وبناء علاقات طويلة الأمد مع عملائنا.',
                'description_en' => 'Achieving the highest levels of customer satisfaction by providing high-quality services and continuous technical support, and building long-term relationships with our clients.',
            ],
            [
                'title' => 'النمو والتوسع',
                'title_en' => 'Growth and Expansion',
                'description' => 'توسيع نطاق خدماتنا وزيادة حصتنا السوقية من خلال فتح فروع جديدة وتطوير خدماتنا لتشمل مجالات جديدة في الدعاية والإعلان.',
                'description_en' => 'Expanding our services and increasing our market share by opening new branches and developing our services to include new areas in advertising and publicity.',
            ],
            [
                'title' => 'المسؤولية الاجتماعية',
                'title_en' => 'Social Responsibility',
                'description' => 'المساهمة في تنمية المجتمع السعودي من خلال دعم المبادرات الاجتماعية والثقافية والرياضية، وتطبيق ممارسات الأعمال المستدامة والمسؤولة بيئياً.',
                'description_en' => 'Contributing to the development of Saudi society by supporting social, cultural, and sports initiatives, and applying sustainable and environmentally responsible business practices.',
            ],
        ];

        foreach ($companyGoals as $goal) {
            CompanyGoal::create($goal);
        }
    }
}
