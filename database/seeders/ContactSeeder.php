<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'phone' => '+966112345678',
            'address' => 'الرياض، حي النخيل، شارع الملك فهد، المملكة العربية السعودية',
            'email' => 'info@alwifak.com',
            'facebook_url' => 'https://facebook.com/alwifak',
            'twitter_url' => 'https://twitter.com/alwifak',
            'linkedin_url' => 'https://linkedin.com/company/alwifak',
            'youtube_url' => 'https://youtube.com/alwifak',
            'instagram_url' => 'https://instagram.com/alwifak',
            'website_url' => 'https://alwifak.com',
            'whatsapp' => '+966501234567',
            'telegram' => 'https://t.me/alwifak',
        ]);
    }
}
