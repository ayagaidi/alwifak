<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InvoiceItem;
use App\Models\Invoice;
use App\Models\Service;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = Invoice::all();
        $services = Service::all();

        if ($invoices->isEmpty() || $services->isEmpty()) {
            return; // Skip if no invoices or services exist
        }

        $invoiceItems = [
            [
                'invoice_id' => $invoices->first()->id,
                'service_id' => $services->first()->id,
                'quantity' => 1,
                'unit_price' => 3000.00,
                'total_price' => 3000.00,
            ],
            [
                'invoice_id' => $invoices->first()->id,
                'service_id' => $services->skip(1)->first()->id,
                'quantity' => 1,
                'unit_price' => 2000.00,
                'total_price' => 2000.00,
            ],
            [
                'invoice_id' => $invoices->skip(1)->first()->id,
                'service_id' => $services->skip(2)->first()->id,
                'quantity' => 1,
                'unit_price' => 2500.00,
                'total_price' => 2500.00,
            ],
            [
                'invoice_id' => $invoices->skip(1)->first()->id,
                'service_id' => $services->skip(3)->first()->id,
                'quantity' => 1,
                'unit_price' => 1000.00,
                'total_price' => 1000.00,
            ],
            [
                'invoice_id' => $invoices->skip(2)->first()->id,
                'service_id' => $services->first()->id,
                'quantity' => 1,
                'unit_price' => 4000.00,
                'total_price' => 4000.00,
            ],
            [
                'invoice_id' => $invoices->skip(2)->first()->id,
                'service_id' => $services->skip(1)->first()->id,
                'quantity' => 1,
                'unit_price' => 3500.00,
                'total_price' => 3500.00,
            ],
            [
                'invoice_id' => $invoices->skip(3)->first()->id,
                'service_id' => $services->skip(4)->first()->id,
                'quantity' => 3,
                'unit_price' => 800.00,
                'total_price' => 2400.00,
            ],
            [
                'invoice_id' => $invoices->skip(3)->first()->id,
                'service_id' => $services->skip(3)->first()->id,
                'quantity' => 3,
                'unit_price' => 400.00,
                'total_price' => 1200.00,
            ],
            [
                'invoice_id' => $invoices->skip(4)->first()->id,
                'service_id' => $services->skip(5)->first()->id,
                'quantity' => 2,
                'unit_price' => 1500.00,
                'total_price' => 3000.00,
            ],
            [
                'invoice_id' => $invoices->skip(4)->first()->id,
                'service_id' => $services->skip(6)->first()->id,
                'quantity' => 1,
                'unit_price' => 1200.00,
                'total_price' => 1200.00,
            ],
        ];

        foreach ($invoiceItems as $item) {
            InvoiceItem::create($item);
        }

        // Update invoice totals
        foreach ($invoices as $invoice) {
            $invoice->calculateTotals();
        }
    }
}
