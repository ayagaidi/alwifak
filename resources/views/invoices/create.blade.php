@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h5 page-title">إنشاء فاتورة جديدة</h2>
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">العودة للقائمة</a>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <form id="invoiceForm" method="POST" action="{{ route('invoices.store') }}">
                            @csrf

                            <!-- Invoice Details -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_id">العميل *</label>
                                        <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                                            <option value="">اختر العميل</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="invoice_date">تاريخ الفاتورة *</label>
                                        <input type="date" class="form-control @error('invoice_date') is-invalid @enderror" id="invoice_date" name="invoice_date" value="{{ old('invoice_date', date('Y-m-d')) }}" required>
                                        @error('invoice_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date">تاريخ الاستحقاق *</label>
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                        @error('due_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_status">حالة الدفع *</label>
                                        <select class="form-control @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                                            <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }}>في الانتظار</option>
                                            <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>مدفوعة</option>
                                            <option value="overdue" {{ old('payment_status') == 'overdue' ? 'selected' : '' }}>متأخرة</option>
                                            <option value="cancelled" {{ old('payment_status') == 'cancelled' ? 'selected' : '' }}>ملغاة</option>
                                        </select>
                                        @error('payment_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_method">طريقة الدفع</label>
                                        <select class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                                            <option value="">اختر طريقة الدفع</option>
                                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>نقدي</option>
                                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                                            <option value="check" {{ old('payment_method') == 'check' ? 'selected' : '' }}>شيك</option>
                                            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>بطاقة ائتمان</option>
                                            <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>أخرى</option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_date">تاريخ الدفع</label>
                                        <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date') }}">
                                        @error('payment_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tax_amount">مبلغ الضريبة</label>
                                        <input type="number" step="0.01" class="form-control @error('tax_amount') is-invalid @enderror" id="tax_amount" name="tax_amount" value="{{ old('tax_amount', 0) }}" min="0">
                                        @error('tax_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount_amount">مبلغ الخصم</label>
                                        <input type="number" step="0.01" class="form-control @error('discount_amount') is-invalid @enderror" id="discount_amount" name="discount_amount" value="{{ old('discount_amount', 0) }}" min="0">
                                        @error('discount_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" maxlength="1000">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Invoice Items -->
                            <h5>عناصر الفاتورة</h5>
                            <div id="invoiceItems">
                                <div class="item-row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control service-select @error('items.0.service_id') is-invalid @enderror" name="items[0][service_id]" required>
                                                <option value="">اختر الخدمة</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}" {{ old('items.0.service_id') == $service->id ? 'selected' : '' }}>
                                                        {{ $service->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('items.0.service_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control quantity-input @error('items.0.quantity') is-invalid @enderror" name="items[0][quantity]" value="{{ old('items.0.quantity', 1) }}" min="1" required>
                                            @error('items.0.quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" class="form-control price-input @error('items.0.unit_price') is-invalid @enderror" name="items[0][unit_price]" value="{{ old('items.0.unit_price') }}" min="0" required>
                                            @error('items.0.unit_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control @error('items.0.description') is-invalid @enderror" name="items[0][description]" value="{{ old('items.0.description') }}" required>
                                            @error('items.0.description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-sm remove-item">حذف</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="addItemBtn" class="btn btn-secondary btn-sm">إضافة عنصر</button>

                            <!-- Totals -->
                            <div class="row mt-3">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="invoice-totals">
                                        <div class="d-flex justify-content-between">
                                            <span>المجموع الفرعي:</span>
                                            <span id="subtotal">0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>الضريبة:</span>
                                            <span id="tax-total">0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>الخصم:</span>
                                            <span id="discount-total">0.00</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between font-weight-bold">
                                            <span>الإجمالي:</span>
                                            <span id="grand-total">0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">إنشاء الفاتورة</button>
                                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">إلغاء</a>
                            </div>
                        </form>
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
    padding: 15px;
    border-radius: 5px;
    margin-top: 10px;
}
.item-row {
    margin-bottom: 10px;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Load services for dynamic rows
    loadServices();

    // Add new item row
    $('#addItemBtn').click(function() {
        addNewItemRow();
    });

    // Remove item row
    $(document).on('click', '.remove-item', function() {
        if ($('#invoiceItems .item-row').length > 1) {
            $(this).closest('.item-row').remove();
            calculateTotals();
        }
    });

    // Calculate totals when quantity or price changes
    $(document).on('input', '.quantity-input, .price-input', function() {
        calculateTotals();
    });

    // Calculate totals when tax or discount changes
    $('#tax_amount, #discount_amount').on('input', function() {
        calculateTotals();
    });

    // Load service description when service is selected
    $(document).on('change', '.service-select', function() {
        var serviceId = $(this).val();
        var $row = $(this).closest('.item-row');
        var $priceInput = $row.find('.price-input');

        if (serviceId) {
            $.get('/invoices/services/list', function(services) {
                var service = services.find(s => s.id == serviceId);
                if (service) {
                    $priceInput.val(service.name_ar);
                    $row.find("input[name*="description"]").val(service.description_ar);
                    calculateTotals();
                }
            });
        }
    });

    function loadServices() {
        $.get('/invoices/services/list', function(services) {
            $('.service-select').each(function() {
                var $select = $(this);
                var selectedValue = $select.val();

                $select.empty();
                $select.append('<option value="">اختر الخدمة</option>');

                services.forEach(function(service) {
                    $select.append('<option value="' + service.id + '">' + service.name + '</option>');
                });

                $select.val(selectedValue);
            });
        });
    }

    function addNewItemRow() {
        var itemCount = $('#invoiceItems .item-row').length;
        var newRow = `
            <div class="item-row">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control service-select" name="items[${itemCount}][service_id]" required>
                            <option value="">اختر الخدمة</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control quantity-input" name="items[${itemCount}][quantity]" placeholder="الكمية" min="1" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" class="form-control price-input" name="items[${itemCount}][unit_price]" placeholder="السعر" min="0" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="items[${itemCount}][description]" placeholder="وصف الخدمة" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-item">حذف</button>
                    </div>
                </div>
            </div>
        `;

        $('#invoiceItems').append(newRow);
        loadServices(); // Reload services for the new row
    }

    function calculateTotals() {
        var subtotal = 0;

        $('#invoiceItems .item-row').each(function() {
            var quantity = parseFloat($(this).find('.quantity-input').val()) || 0;
            var price = parseFloat($(this).find('.price-input').val()) || 0;
            subtotal += quantity * price;
        });

        var tax = parseFloat($('#tax_amount').val()) || 0;
        var discount = parseFloat($('#discount_amount').val()) || 0;
        var grandTotal = subtotal + tax - discount;

        $('#subtotal').text(subtotal.toFixed(2));
        $('#tax-total').text(tax.toFixed(2));
        $('#discount-total').text(discount.toFixed(2));
        $('#grand-total').text(grandTotal.toFixed(2));
    }

    // Initialize totals calculation
    calculateTotals();
});
</script>
@endpush
