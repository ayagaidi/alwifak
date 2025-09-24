<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Customer;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            // Create some customers if none exist
            $customers = Customer::factory(5)->create();
        }

        $invoices = [
            [
                'invoice_number' => 'INV-2024-001',
                'customer_id' => $customers->first()->id,
                'invoice_date' => Carbon::now()->subDays(30),
                'due_date' => Carbon::now()->subDays(15),
                'payment_status' => 'paid',
                'payment_method' => 'bank_transfer',
                'payment_date' => Carbon::now()->subDays(20),
                'subtotal' => 5000.00,
                'tax_amount' => 750.00,
                'discount_amount' => 0.00,
                'total_amount' => 5750.00,
                'notes' => 'خدمات تصميم الهوية البصرية والتسويق الرقمي',
            ],
            [
                'invoice_number' => 'INV-2024-002',
                'customer_id' => $customers->skip(1)->first()->id,
                'invoice_date' => Carbon::now()->subDays(20),
                'due_date' => Carbon::now()->subDays(5),
                'payment_status' => 'paid',
                'payment_method' => 'cash',
                'payment_date' => Carbon::now()->subDays(10),
                'subtotal' => 3500.00,
                'tax_amount' => 525.00,
                'discount_amount' => 175.00,
                'total_amount' => 3850.00,
                'notes' => 'تصميم موقع إلكتروني وإنتاج محتوى',
            ],
            [
                'invoice_number' => 'INV-2024-003',
                'customer_id' => $customers->skip(2)->first()->id,
                'invoice_date' => Carbon::now()->subDays(10),
                'due_date' => Carbon::now()->addDays(20),
                'payment_status' => 'pending',
                'payment_method' => null,
                'payment_date' => null,
                'subtotal' => 7500.00,
                'tax_amount' => 1125.00,
                'discount_amount' => 0.00,
                'total_amount' => 8625.00,
                'notes' => 'حملة إعلانية متكاملة تشمل جميع الخدمات',
            ],
            [
                'invoice_number' => 'INV-2024-004',
                'customer_id' => $customers->skip(3)->first()->id,
                'invoice_date' => Carbon::now()->subDays(5),
                'due_date' => Carbon::now()->addDays(25),
                'payment_status' => 'pending',
                'payment_method' => null,
                'payment_date' => null,
                'subtotal' => 2800.00,
                'tax_amount' => 420.00,
                'discount_amount' => 140.00,
                'total_amount' => 3080.00,
                'notes' => 'إدارة وسائل التواصل الاجتماعي لمدة 3 أشهر',
            ],
            [
                'invoice_number' => 'INV-2024-005',
                'customer_id' => $customers->skip(4)->first()->id,
                'invoice_date' => Carbon::now()->subDays(15),
                'due_date' => Carbon::now()->addDays(15),
                'payment_status' => 'overdue',
                'payment_method' => null,
                'payment_date' => null,
                'subtotal' => 4200.00,
                'tax_amount' => 630.00,
                'discount_amount' => 0.00,
                'total_amount' => 4830.00,
                'notes' => 'خدمات التصوير الفوتوغرافي وإنتاج الفيديو',
            ],
        ];

        foreach ($invoices as $invoice) {
            Invoice::create($invoice);
        }
    }
}
