@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });
</script>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h5 page-title">تعديل الفاتورة</h2>
                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-secondary">عرض الفاتورة</a>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <form id="invoiceForm" method="POST" action="{{ route('invoices.update', $invoice) }}">
                            @csrf
                            @method('PUT')

                            <!-- Invoice Details -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_id">العميل *</label>
                                        <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                                            <option value="">اختر العميل</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
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
                                        <input type="date" class="form-control @error('invoice_date') is-invalid @enderror" id="invoice_date" name="invoice_date" value="{{ $invoice->invoice_date->format('Y-m-d') }}" required>
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
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ $invoice->due_date->format('Y-m-d') }}" required>
                                        @error('due_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_status">حالة الدفع *</label>
                                        <select class="form-control @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                                            <option value="pending" {{ $invoice->payment_status == 'pending' ? 'selected' : '' }}>في الانتظار</option>
                                            <option value="paid" {{ $invoice->payment_status == 'paid' ? 'selected' : '' }}>مدفوعة</option>
                                            <option value="overdue" {{ $invoice->payment_status == 'overdue' ? 'selected' : '' }}>متأخرة</option>
                                            <option value="cancelled" {{ $invoice->payment_status == 'cancelled' ? 'selected' : '' }}>ملغاة</option>
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
                                            <option value="cash" {{ $invoice->payment_method == 'cash' ? 'selected' : '' }}>نقدي</option>
                                            <option value="bank_transfer" {{ $invoice->payment_method == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                                            <option value="check" {{ $invoice->payment_method == 'check' ? 'selected' : '' }}>شيك</option>
                                            <option value="credit_card" {{ $invoice->payment_method == 'credit_card' ? 'selected' : '' }}>بطاقة ائتمان</option>
                                            <option value="other" {{ $invoice->payment_method == 'other' ? 'selected' : '' }}>أخرى</option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_date">تاريخ الدفع</label>
                                        <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ $invoice->payment_date ? $invoice->payment_date->format('Y-m-d') : '' }}">
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
                                        <input type="number" step="0.01" class="form-control @error('tax_amount') is-invalid @enderror" id="tax_amount" name="tax_amount" value="{{ $invoice->tax_amount }}" min="0">
                                        @error('tax_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount_amount">مبلغ الخصم</label>
                                        <input type="number" step="0.01" class="form-control @error('discount_amount') is-invalid @enderror" id="discount_amount" name="discount_amount" value="{{ $invoice->discount_amount }}" min="0">
                                        @error('discount_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" maxlength="1000">{{ $invoice->notes }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Invoice Items -->
                            <h5>عناصر الفاتورة</h5>
                            <div id="invoiceItems">
                                @foreach($invoice->items as $index => $item)
                                <div class="item-row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control service-select @error('items.' . $index . '.service_id') is-invalid @enderror" name="items[{{ $index }}][service_id]" required>
                                                <option value="">اختر الخدمة</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}" {{ $item->service_id == $service->id ? 'selected' : '' }}>
                                                        {{ $service->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('items.' . $index . '.service_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control quantity-input @error('items.' . $index . '.quantity') is-invalid @enderror" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" min="1" required>
                                            @error('items.' . $index . '.quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" class="form-control price-input @error('items.' . $index . '.unit_price') is-invalid @enderror" name="items[{{ $index }}][unit_price]" value="{{ $item->unit_price }}" min="0" required>
                                            @error('items.' . $index . '.unit_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                       
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-sm remove-item">حذف</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" id="addItemBtn" class="btn btn-secondary btn-sm">إضافة عنصر</button>

                            <!-- Totals -->
                            <div class="row mt-3">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="invoice-totals">
                                        <div class="d-flex justify-content-between">
                                            <span>المجموع الفرعي:</span>
                                            <span id="subtotal">{{ number_format($invoice->subtotal, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>الضريبة:</span>
                                            <span id="tax-total">{{ number_format($invoice->tax_amount, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>الخصم:</span>
                                            <span id="discount-total">{{ number_format($invoice->discount_amount, 2) }}</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between font-weight-bold">
                                            <span>الإجمالي:</span>
                                            <span id="grand-total">{{ number_format($invoice->total_amount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">تحديث الفاتورة</button>
                                <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-secondary">إلغاء</a>
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
$(function () {
    let servicesCache = null;

    // ====== Helpers ======
    function clearErrors() {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback.dynamic').remove();
    }
    function setFieldError(name, message) {
        // يدعم أسماء مثل items[0][unit_price]
        const esc = name.replace(/\[/g,'\\[').replace(/\]/g,'\\]');
        const $field = $('[name="' + name + '"]');
        if ($field.length) {
            $field.addClass('is-invalid');
            const feedback = $('<div class="invalid-feedback dynamic"></div>').text(message);
            if ($field.next('.invalid-feedback').length) {
                $field.next('.invalid-feedback').text(message);
            } else {
                $field.after(feedback);
            }
        } else {
            // fallback لو الاسم مش موجود حرفيًا (حالة صفوف ديناميكية)
            $('[name$="' + esc + '"]').addClass('is-invalid')
                .after($('<div class="invalid-feedback dynamic"></div>').text(message));
        }
    }
    async function fetchServices() {
        if (servicesCache) return servicesCache;
        const res = await $.get('/invoices/services/list');
        servicesCache = res || [];
        return servicesCache;
    }
    async function loadServices() {
        const services = await fetchServices();
        $('.service-select').each(function () {
            const $select = $(this);
            const selected = $select.val() || '';
            $select.empty().append('<option value="">اختر الخدمة</option>');
            services.forEach(s => {
                $select.append('<option value="'+s.id+'">'+(s.name_ar || s.name || ('#'+s.id))+'</option>');
            });
            if (selected) $select.val(selected);
        });
    }
    function calculateTotals() {
        let subtotal = 0;
        $('#invoiceItems .item-row').each(function () {
            const q = parseFloat($(this).find('.quantity-input').val()) || 0;
            const p = parseFloat($(this).find('.price-input').val()) || 0;
            subtotal += q * p;
        });
        const tax = parseFloat($('#tax_amount').val()) || 0;
        const disc = parseFloat($('#discount_amount').val()) || 0;
        const grand = subtotal + tax - disc;
        $('#subtotal').text(subtotal.toFixed(2));
        $('#tax-total').text(tax.toFixed(2));
        $('#discount-total').text(disc.toFixed(2));
        $('#grand-total').text(grand.toFixed(2));
    }
    async function addNewItemRow() {
        const idx = $('#invoiceItems .item-row').length;
        const row = `
        <div class="item-row">
          <div class="row">
            <div class="col-md-4">
              <select class="form-control service-select" name="items[${idx}][service_id]" required>
                <option value="">اختر الخدمة</option>
              </select>
            </div>
            <div class="col-md-2">
              <input type="number" class="form-control quantity-input" name="items[${idx}][quantity]" value="1" min="1" required>
            </div>
            <div class="col-md-2">
              <input type="number" step="0.01" class="form-control price-input" name="items[${idx}][unit_price]" min="0" required>
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-danger btn-sm remove-item">حذف</button>
            </div>
          </div>
        </div>`;
        $('#invoiceItems').append(row);
        await loadServices();
    }

    // ====== Events ======
    $('#addItemBtn').on('click', addNewItemRow);

    $(document).on('click', '.remove-item', function () {
        $(this).closest('.item-row').remove();
        calculateTotals();
    });

    $(document).on('input', '.quantity-input, .price-input', calculateTotals);
    $('#tax_amount, #discount_amount').on('input', calculateTotals);

    // عند تغيير الخدمة: املأ السعر من بيانات الخدمة (unit_price/price)
    $(document).on('change', '.service-select', async function () {
        const id = $(this).val();
        const $row = $(this).closest('.item-row');
        const $price = $row.find('.price-input');
        if (!id) return;

        const services = await fetchServices();
        const service = services.find(s => String(s.id) === String(id));
        if (service) {
            const unitPrice = service.unit_price ?? service.price ?? service.default_price ?? '';
            if (unitPrice !== '') $price.val(unitPrice);
            calculateTotals();
        }
    });

    // ====== AJAX submit ======
    $('#invoiceForm').on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        const $form = $(this);
        const action = $form.attr('action');
        const formData = $form.serialize(); // يحتوي على _method=PUT من الـ @method('PUT')

        // زر التحميل
        const $btn = $form.find('button[type="submit"]');
        const oldText = $btn.html();
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> جاري الحفظ...');

        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            dataType: 'json'
        })
        .done(function (resp) {
            if (resp && resp.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'تم التحديث',
                    text: 'تم تحديث الفاتورة بنجاح',
                    confirmButtonText: 'عرض الفاتورة'
                }).then(() => {
                    // وجّه لصفحة عرض الفاتورة
                    window.location.href = "{{ route('invoices.show', $invoice) }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'تعذّر التحديث',
                    text: (resp && resp.error) ? resp.error : 'حدث خطأ غير متوقع'
                });
            }
        })
        .fail(function (xhr) {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                const errors = xhr.responseJSON.errors;
                // أبرز الحقول اللي فيها أخطاء
                Object.keys(errors).forEach(function (name) {
                    setFieldError(name, errors[name][0]);
                });
                // رسالة عامة
                Swal.fire({
                    icon: 'warning',
                    title: 'تحقق من الحقول',
                    text: 'بعض البيانات غير صحيحة. من فضلك صحّح الأخطاء المظللة.'
                });
            } else {
                const msg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : 'خطأ في الخادم، حاول مرة أخرى.';
                Swal.fire({
                    icon: 'error',
                    title: 'تعذّر التحديث',
                    text: msg
                });
            }
        })
        .always(function () {
            $btn.prop('disabled', false).html(oldText);
            calculateTotals();
        });
    });

    // Init
    (async function init() {
        await loadServices();
        calculateTotals();
    })();
});
</script>
@endpush

