<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name_ar' => 'شركة الاتصالات السعودية',
                'name_en' => 'Saudi Telecom Company',
                'image' => 'partners/stc-logo.svg',
                'link' => 'https://stc.com.sa',
            ],
            [
                'name_ar' => 'البنك الأهلي السعودي',
                'name_en' => 'Al Ahli Bank',
                'image' => 'partners/alahli-logo.svg',
                'link' => 'https://alahli.com',
            ],
            [
                'name_ar' => 'شركة أرامكو السعودية',
                'name_en' => 'Saudi Aramco',
                'image' => 'partners/aramco-logo.svg',
                'link' => 'https://aramco.com',
            ],
            [
                'name_ar' => 'مجموعة صافولا',
                'name_en' => 'Savola Group',
                'image' => 'partners/savola-logo.svg',
                'link' => 'https://savola.com',
            ],
            [
                'name_ar' => 'شركة الزيت العربية السعودية',
                'name_en' => 'Saudi Oil Company',
                'image' => 'partners/saudi-oil-logo.svg',
                'link' => 'https://saudioil.com',
            ],
            [
                'name_ar' => 'البنك السعودي الفرنسي',
                'name_en' => 'Banque Saudi Fransi',
                'image' => 'partners/bsf-logo.svg',
                'link' => 'https://bsf.com.sa',
            ],
            [
                'name_ar' => 'شركة الكهرباء السعودية',
                'name_en' => 'Saudi Electricity Company',
                'image' => 'partners/sec-logo.svg',
                'link' => 'https://se.com.sa',
            ],
            [
                'name_ar' => 'مجموعة بن لادن السعودية',
                'name_en' => 'Bin Laden Group',
                'image' => 'partners/binladen-logo.svg',
                'link' => 'https://binladengroup.com',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
