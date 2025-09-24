@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">{{ __('invoices.invoices_management') }}</h2>

                <div class="mb-3">
                    <button id="btnAddInvoice" class="btn btn-primary">
                        {{ __('invoices.add_invoice') }}
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="invoicesTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ __('invoices.invoice_number') }}</th>
                                    <th>{{ __('invoices.customer_name') }}</th>
                                    <th>{{ __('invoices.invoice_date') }}</th>
                                    <th>{{ __('invoices.due_date') }}</th>
                                    <th>{{ __('invoices.payment_status') }}</th>
                                    <th>{{ __('invoices.total_amount') }}</th>
                                    <th>{{ __('invoices.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit Invoice -->
                <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form id="invoiceForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="invoiceModalLabel">{{ __('invoices.add_invoice') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('invoices.cancel') }}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="invoiceId" name="invoiceId" value="">

                                    <!-- Invoice Details -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="customer_id">{{ __('invoices.customer_name') }}</label>
                                                <select class="form-control" id="customer_id" name="customer_id" required>
                                                    <option value="">{{ __('invoices.select_customer') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="invoice_date">{{ __('invoices.invoice_date') }}</label>
                                                <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="due_date">{{ __('invoices.due_date') }}</label>
                                                <input type="date" class="form-control" id="due_date" name="due_date" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="payment_status">{{ __('invoices.payment_status') }}</label>
                                                <select class="form-control" id="payment_status" name="payment_status" required>
                                                    <option value="pending">{{ __('invoices.pending') }}</option>
                                                    <option value="paid">{{ __('invoices.paid') }}</option>
                                                    <option value="overdue">{{ __('invoices.overdue') }}</option>
                                                    <option value="cancelled">{{ __('invoices.cancelled') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="payment_method">{{ __('invoices.payment_method') }}</label>
                                                <select class="form-control" id="payment_method" name="payment_method">
                                                    <option value="">{{ __('invoices.select_payment_method') }}</option>
                                                    <option value="cash">{{ __('invoices.cash') }}</option>
                                                    <option value="bank_transfer">{{ __('invoices.bank_transfer') }}</option>
                                                    <option value="check">{{ __('invoices.check') }}</option>
                                                    <option value="credit_card">{{ __('invoices.credit_card') }}</option>
                                                    <option value="other">{{ __('invoices.other') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="payment_date">{{ __('invoices.payment_date') }}</label>
                                                <input type="date" class="form-control" id="payment_date" name="payment_date">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tax_amount">{{ __('invoices.tax_amount') }}</label>
                                                <input type="number" step="0.01" class="form-control" id="tax_amount" name="tax_amount" value="0" min="0">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="discount_amount">{{ __('invoices.discount_amount') }}</label>
                                                <input type="number" step="0.01" class="form-control" id="discount_amount" name="discount_amount" value="0" min="0">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="notes">{{ __('invoices.notes') }}</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3" maxlength="1000"></textarea>
                                    </div>

                                    <!-- Invoice Items -->
                                    <h5>{{ __('invoices.invoice_items') }}</h5>
                                    <div id="invoiceItems">
                                        <div class="item-row">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control service-select" name="items[0][service_id]" required>
                                                        <option value="">{{ __('invoices.select_service') }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control quantity-input" name="items[0][quantity]" placeholder="{{ __('invoices.quantity') }}" min="1" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" step="0.01" class="form-control price-input" name="items[0][unit_price]" placeholder="{{ __('invoices.unit_price') }}" min="0" required>
                                                </div>

                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn-sm remove-item" style="display: none;">{{ __('invoices.remove_item') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" id="addItemBtn" class="btn btn-secondary btn-sm">{{ __('invoices.add_item') }}</button>

                                    <!-- Totals -->
                                    <div class="row mt-3">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <div class="invoice-totals">
                                                <div class="d-flex justify-content-between">
                                                    <span>{{ __('invoices.subtotal') }}:</span>
                                                    <span id="subtotal">0.00</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>{{ __('invoices.tax_amount') }}:</span>
                                                    <span id="tax-total">0.00</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>{{ __('invoices.discount_amount') }}:</span>
                                                    <span id="discount-total">0.00</span>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between font-weight-bold">
                                                    <span>{{ __('invoices.grand_total') }}:</span>
                                                    <span id="grand-total">0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('invoices.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('invoices.save') }}</button>
                                </div>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#invoicesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("invoices.index") }}',
        columns: [
            { data: 'invoice_number', name: 'invoice_number' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'invoice_date', name: 'invoice_date' },
            { data: 'due_date', name: 'due_date' },
            { data: 'payment_status_badge', name: 'payment_status' },
            { data: 'total_amount', name: 'total_amount', render: function(data) { return parseFloat(data).toFixed(2); } },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: 'ar.json'
        }
    });

    // Load customers and services
    loadCustomers();
    loadServices();

    // Open modal for adding invoice
    $('#btnAddInvoice').click(function() {
        $('#invoiceForm')[0].reset();
        $('#invoiceId').val('');
        $('#invoiceModalLabel').text('{{ __("invoices.add_invoice") }}');
        $('#invoiceModal').modal('show');
        addNewItemRow();
    });

    // Open modal for editing invoice
    $('#invoicesTable').on('click', '.btn-edit', function() {
        var invoiceId = $(this).data('invoice-id');
        editInvoice(invoiceId);
    });

    // View invoice
    $('#invoicesTable').on('click', '.btn-view', function() {
        var invoiceId = $(this).data('invoice-id');
        window.location.href = '/invoices/' + invoiceId;
    });

    // Submit form for add/edit invoice
    $('#invoiceForm').submit(function(e) {
        e.preventDefault();
        saveInvoice();
    });

    // Delete invoice
    $('#invoicesTable').on('click', '.btn-delete', function() {
        var invoiceId = $(this).data('invoice-id');

        Swal.fire({
            title: '{{ __("invoices.confirm_delete") }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{ __("invoices.confirm_delete_yes") }}',
            cancelButtonText: '{{ __("invoices.cancel") }}',
        }).then((result) => {
            if (result.isConfirmed) {
                deleteInvoice(invoiceId);
            }
        });
    });

    // Add new item row
    $('#addItemBtn').click(function() {
        addNewItemRow();
    });

    // Remove item row
    $(document).on('click', '.remove-item', function() {
        $(this).closest('.item-row').remove();
        calculateTotals();
    });

    // Calculate totals when quantity or price changes
    $(document).on('input', '.quantity-input, .price-input', function() {
        calculateTotals();
    });

    // Calculate totals when tax or discount changes
    $('#tax_amount, #discount_amount').on('input', function() {
        calculateTotals();
    });

    // Load service price when service is selected
    $(document).on('change', '.service-select', function() {
        var serviceId = $(this).val();
        var $row = $(this).closest('.item-row');
        var $priceInput = $row.find('.price-input');

        if (serviceId) {
            $.get('/invoices/services/list', function(services) {
                var service = services.find(s => s.id == serviceId);
                if (service) {
                    $priceInput.val(service.price);
                    calculateTotals();
                }
            });
        }
    });

    function loadCustomers() {
        $.get('/customers', function(data) {
            var $select = $('#customer_id');
            $select.empty();
            $select.append('<option value="">{{ __("invoices.select_customer") }}</option>');
            data.data.forEach(function(customer) {
                $select.append('<option value="' + customer.id + '">' + customer.name + '</option>');
            });
        });
    }

    function loadServices() {
        $.get('/invoices/services/list', function(services) {
            $('.service-select').each(function() {
                var $select = $(this);
                $select.empty();
                $select.append('<option value="">{{ __("invoices.select_service") }}</option>');
                services.forEach(function(service) {
                    $select.append('<option value="' + service.id + '">' + service.name_ar + '</option>');
                });
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
                            <option value="">{{ __("invoices.select_service") }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control quantity-input" name="items[${itemCount}][quantity]" placeholder="{{ __("invoices.quantity") }}" min="1" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" class="form-control price-input" name="items[${itemCount}][unit_price]" placeholder="{{ __("invoices.unit_price") }}" min="0" required>
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-item">{{ __("invoices.remove_item") }}</button>
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

    function editInvoice(invoiceId) {
        $.get('/invoices/' + invoiceId + '/edit', function(data) {
            $('#invoiceForm')[0].reset();
            $('#invoiceId').val(data.invoice.id);
            $('#customer_id').val(data.invoice.customer_id);
            $('#invoice_date').val(data.invoice.invoice_date);
            $('#due_date').val(data.invoice.due_date);
            $('#payment_status').val(data.invoice.payment_status);
            $('#payment_method').val(data.invoice.payment_method);
            $('#payment_date').val(data.invoice.payment_date);
            $('#tax_amount').val(data.invoice.tax_amount);
            $('#discount_amount').val(data.invoice.discount_amount);
            $('#notes').val(data.invoice.notes);

            // Clear existing items
            $('#invoiceItems').empty();

            // Add invoice items
            data.invoice.items.forEach(function(item, index) {
                var itemRow = `
                    <div class="item-row">
                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-control service-select" name="items[${index}][service_id]" required>
                                    <option value="">{{ __("invoices.select_service") }}</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control quantity-input" name="items[${index}][quantity]" value="${item.quantity}" min="1" required>
                            </div>
                            <div class="col-md-2">
                                <input type="number" step="0.01" class="form-control price-input" name="items[${index}][unit_price]" value="${item.unit_price}" min="0" required>
                            </div>

                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm remove-item">{{ __("invoices.remove_item") }}</button>
                            </div>
                        </div>
                    </div>
                `;
                $('#invoiceItems').append(itemRow);
            });

            loadServices();
            // Set selected services
            setTimeout(function() {
                data.invoice.items.forEach(function(item, index) {
                    $('select[name="items[' + index + '][service_id]"]').val(item.service_id);
                });
                calculateTotals();
            }, 100);

            $('#invoiceModalLabel').text('{{ __("invoices.edit_invoice") }}');
            $('#invoiceModal').modal('show');
        });
    }

    function saveInvoice() {
        var invoiceId = $('#invoiceId').val();
        var url = invoiceId ? '/invoices/' + invoiceId : '/invoices';
        var method = invoiceId ? 'PUT' : 'POST';

        var formData = new FormData($('#invoiceForm')[0]);

        $.ajax({
            url: url,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: '{{ __("invoices.success") }}',
                    text: response.message,
                }).then(() => {
                    table.ajax.reload(null, false);
                    $('#invoiceModal').modal('hide');
                });
            },
            error: function(xhr) {
                var errorMessage = '{{ __("invoices.error_occurred") }}';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("invoices.error") }}',
                    text: errorMessage,
                });
            }
        });
    }

    function deleteInvoice(invoiceId) {
        $.ajax({
            url: '/invoices/' + invoiceId,
            method: 'DELETE',
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: '{{ __("invoices.success") }}',
                    text: response.message,
                });
                table.ajax.reload(null, false);
            },
            error: function(xhr) {
                var errorMessage = '{{ __("invoices.error_occurred") }}';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("invoices.error") }}',
                    text: errorMessage,
                });
            }
        });
    }
});
</script>
@endpush
