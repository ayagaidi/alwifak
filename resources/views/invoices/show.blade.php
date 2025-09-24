@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h5 page-title">عرض الفاتورة</h2>
                    <div>
                        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">العودة للقائمة</a>
                        <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-primary">تعديل</a>
                        <button class="btn btn-success" onclick="printInvoice()">طباعة</button>
                    </div>
                </div>

                <div class="card shadow" id="invoice-content">
                    <div class="card-body">
                        <!-- Invoice Header -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h3 class="text-primary">فاتورة</h3>
                                <p class="mb-1"><strong>رقم الفاتورة:</strong> {{ $invoice->invoice_number }}</p>
                                <p class="mb-1"><strong>تاريخ الفاتورة:</strong> {{ $invoice->invoice_date->format('Y-m-d') }}</p>
                                <p class="mb-1"><strong>تاريخ الاستحقاق:</strong> {{ $invoice->due_date->format('Y-m-d') }}</p>
                            </div>
                            <div class="col-md-6 text-left">
                                <h4>معلومات العميل</h4>
                                <p class="mb-1"><strong>الاسم:</strong> {{ $invoice->customer->name }}</p>
                                <p class="mb-1"><strong>رقم الهاتف:</strong> {{ $invoice->customer->phone }}</p>
                                <p class="mb-1"><strong>البريد الإلكتروني:</strong> {{ $invoice->customer->email ?? 'غير محدد' }}</p>
                                <p class="mb-1"><strong>العنوان:</strong> {{ $invoice->customer->address }}</p>
                            </div>
                        </div>

                        <!-- Invoice Items -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الخدمة</th>
                                        <th>الكمية</th>
                                        <th>سعر الوحدة</th>
                                        <th>الإجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->items as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->service->name_ar ?? 'خدمة محذوفة' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->unit_price, 2) }}</td>
                                        <td>{{ number_format($item->total_price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Invoice Totals -->
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <div class="invoice-totals">
                                    <div class="d-flex justify-content-between">
                                        <span>المجموع الفرعي:</span>
                                        <span>{{ number_format($invoice->subtotal, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>الضريبة:</span>
                                        <span>{{ number_format($invoice->tax_amount, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>الخصم:</span>
                                        <span>{{ number_format($invoice->discount_amount, 2) }}</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between font-weight-bold h5">
                                        <span>الإجمالي:</span>
                                        <span>{{ number_format($invoice->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>معلومات الدفع</h5>
                                <div class="d-flex justify-content-between">
                                    <span>حالة الدفع:</span>
                                    <span>
                                        @switch($invoice->payment_status)
                                            @case('pending')
                                                <span class="badge badge-warning">في الانتظار</span>
                                                @break
                                            @case('paid')
                                                <span class="badge badge-success">مدفوعة</span>
                                                @break
                                            @case('overdue')
                                                <span class="badge badge-danger">متأخرة</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge badge-secondary">ملغاة</span>
                                                @break
                                        @endswitch
                                    </span>
                                </div>
                                @if($invoice->payment_method)
                                <div class="d-flex justify-content-between">
                                    <span>طريقة الدفع:</span>
                                    <span>
                                        @switch($invoice->payment_method)
                                            @case('cash')
                                                نقدي
                                                @break
                                            @case('bank_transfer')
                                                تحويل بنكي
                                                @break
                                            @case('check')
                                                شيك
                                                @break
                                            @case('credit_card')
                                                بطاقة ائتمان
                                                @break
                                            @case('other')
                                                أخرى
                                                @break
                                        @endswitch
                                    </span>
                                </div>
                                @endif
                                @if($invoice->payment_date)
                                <div class="d-flex justify-content-between">
                                    <span>تاريخ الدفع:</span>
                                    <span>{{ $invoice->payment_date->format('Y-m-d') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($invoice->notes)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>ملاحظات</h5>
                                <div class="alert alert-info">
                                    {{ $invoice->notes }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
.invoice-totals {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
    margin-top: 20px;
}

@media print {
    .btn, .page-title, .d-flex.justify-content-between.align-items-center {
        display: none !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }

    .invoice-content {
        margin: 0;
        padding: 0;
    }
}
</style>
@endpush

@push('scripts')
<script>
function printInvoice() {
    window.print();
}
</script>
@endpush
