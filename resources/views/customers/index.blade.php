@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">إدارة العملاء</h2>

                <div class="mb-3">
                    <button id="btnAddCustomer" class="btn btn-primary">
                        إضافة عميل جديد
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="customersTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم العميل</th>
                                    <th>رقم الهاتف</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>اسم الشركة</th>
                                    <th>العنوان</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit Customer -->
                <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="customerForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="customerModalLabel">إضافة عميل</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="customerId" name="customerId" value="">
                                    <div class="form-group">
                                        <label for="name">اسم العميل</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">البريد الإلكتروني (اختياري)</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم الشركة (اختياري)</label>
                                        <input type="text" class="form-control" id="company" name="company">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">العنوان</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                    <button type="submit" class="btn btn-primary">حفظ</button>
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
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#customersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("customers.index") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'email', name: 'email' },
            { data: 'company', name: 'company' },
            { data: 'address', name: 'address' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: 'ar.json'
        }
    });

    // Open modal for adding customer
    $('#btnAddCustomer').click(function() {
        $('#customerForm')[0].reset();
        $('#customerId').val('');
        $('#customerModalLabel').text('إضافة عميل');
        $('#customerModal').modal('show');
    });

    // Open modal for editing customer
    $('#customersTable').on('click', '.btn-edit', function() {
        var customerId = $(this).data('customer-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#customerForm')[0].reset();
        $('#customerId').val(customerId);
        $('#name').val(rowData.name);
        $('#phone').val(rowData.phone);
        $('#email').val(rowData.email);
        $('#company').val(rowData.company);
        $('#address').val(rowData.address);
        $('#customerModalLabel').text('تعديل عميل');
        $('#customerModal').modal('show');
    });

    // Submit form for add/edit customer
    $('#customerForm').submit(function(e) {
        e.preventDefault();

        var customerId = $('#customerId').val();
        var url = customerId ? '/customers/' + customerId : '/customers';
        var method = customerId ? 'PUT' : 'POST';

        var data = {
            name: $('#name').val(),
            phone: $('#phone').val(),
            email: $('#email').val(),
            company: $('#company').val(),
            address: $('#address').val(),
        };

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'نجاح',
                    text: response.message,
                }).then(() => {
                    table.ajax.reload(null, false);
                    $('#customerModal').modal('hide');
                });
            },
            error: function(xhr) {
                var errorMessage = 'حدث خطأ';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: errorMessage,
                });
            }
        });
    });

    // Delete customer
    $('#customersTable').on('click', '.btn-delete', function() {
        var customerId = $(this).data('customer-id');

        Swal.fire({
            title: 'هل أنت متأكد من حذف العميل؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/customers/' + customerId,
                    method: 'DELETE',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'نجاح',
                            text: response.message,
                        });
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        var errorMessage = 'حدث خطأ';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: errorMessage,
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush
