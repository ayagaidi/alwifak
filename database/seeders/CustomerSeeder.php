<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'أحمد محمد علي',
                'phone' => '+966501234567',
                'email' => 'ahmed.mohamed@company.com',
                'company' => 'شركة التقنية المتقدمة',
                'address' => 'الرياض، المملكة العربية السعودية',
            ],
            [
                'name' => 'فاطمة أحمد حسن',
                'phone' => '+966507654321',
                'email' => 'fatima.ahmed@techcorp.com',
                'company' => 'مؤسسة الابتكار الرقمي',
                'address' => 'جدة، المملكة العربية السعودية',
            ],
            [
                'name' => 'محمد عبدالله سالم',
                'phone' => '+966509876543',
                'email' => 'mohamed.salem@innovate.sa',
                'company' => 'شركة الابتكار السعودية',
                'address' => 'الدمام، المملكة العربية السعودية',
            ],
            [
                'name' => 'سارة خالد المحمد',
                'phone' => '+966502468135',
                'email' => 'sara.khaled@digitalage.com',
                'company' => 'العصر الرقمي المحدودة',
                'address' => 'الرياض، المملكة العربية السعودية',
            ],
            [
                'name' => 'عمر يوسف العتيبي',
                'phone' => '+966503579246',
                'email' => 'omar.yusuf@smarttech.com',
                'company' => 'التقنية الذكية',
                'address' => 'مكة المكرمة، المملكة العربية السعودية',
            ],
            [
                'name' => 'نورة سعد الدوسري',
                'phone' => '+966506813579',
                'email' => 'noura.saad@creative.com',
                'company' => 'الإبداع للدعاية والإعلان',
                'address' => 'الخبر، المملكة العربية السعودية',
            ],
            [
                'name' => 'خالد فيصل الراجحي',
                'phone' => '+966504792613',
                'email' => 'khaled.faisal@modernmedia.com',
                'company' => 'الإعلام الحديث',
                'address' => 'الرياض، المملكة العربية السعودية',
            ],
            [
                'name' => 'لينا محمد القاسم',
                'phone' => '+966501357924',
                'email' => 'lina.mohamed@brandplus.com',
                'company' => 'براند بلس',
                'address' => 'جدة، المملكة العربية السعودية',
            ],
            [
                'name' => 'عبدالرحمن أحمد الشهري',
                'phone' => '+966508642975',
                'email' => 'abdulrahman@visionary.com',
                'company' => 'الرؤية الإبداعية',
                'address' => 'المدينة المنورة، المملكة العربية السعودية',
            ],
            [
                'name' => 'هند عبدالعزيز التميمي',
                'phone' => '+966503186429',
                'email' => 'hind.tamimi@digitalwave.com',
                'company' => 'الموجة الرقمية',
                'address' => 'الرياض، المملكة العربية السعودية',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
