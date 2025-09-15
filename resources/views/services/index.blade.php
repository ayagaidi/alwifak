@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">إدارة الخدمات</h2>

                <div class="mb-3">
                    <button id="btnAddService" class="btn btn-primary">
                        إضافة خدمة جديدة
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="servicesTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الخدمة (عربي)</th>
                                    <th>اسم الخدمة (إنجليزي)</th>
                                    <th>وصف الخدمة (عربي)</th>
                                    <th>وصف الخدمة (إنجليزي)</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit Service -->
                <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form id="serviceForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="serviceModalLabel">إضافة خدمة</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="serviceId" name="serviceId" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_ar">اسم الخدمة (عربي)</label>
                                                <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_en">اسم الخدمة (إنجليزي)</label>
                                                <input type="text" class="form-control" id="name_en" name="name_en" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description_ar">وصف الخدمة (عربي)</label>
                                                <textarea class="form-control" id="description_ar" name="description_ar" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description_en">وصف الخدمة (إنجليزي)</label>
                                                <textarea class="form-control" id="description_en" name="description_en" rows="3"></textarea>
                                            </div>
                                        </div>
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
    var table = $('#servicesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("services.index") }}',
        columns: [
            { data: 'name_ar', name: 'name_ar' },
            { data: 'name_en', name: 'name_en' },
            { data: 'description_ar', name: 'description_ar' },
            { data: 'description_en', name: 'description_en' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: 'ar.json'
        }
    });

    // Open modal for adding service
    $('#btnAddService').click(function() {
        $('#serviceForm')[0].reset();
        $('#serviceId').val('');
        $('#serviceModalLabel').text('إضافة خدمة');
        $('#serviceModal').modal('show');
    });

    // Open modal for editing service
    $('#servicesTable').on('click', '.btn-edit', function() {
        var serviceId = $(this).data('service-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#serviceForm')[0].reset();
        $('#serviceId').val(serviceId);
        $('#name_ar').val(rowData.name_ar);
        $('#name_en').val(rowData.name_en);
        $('#description_ar').val(rowData.description_ar);
        $('#description_en').val(rowData.description_en);
        $('#serviceModalLabel').text('تعديل خدمة');
        $('#serviceModal').modal('show');
    });

    // Submit form for add/edit service
    $('#serviceForm').submit(function(e) {
        e.preventDefault();

        var serviceId = $('#serviceId').val();
        var url = serviceId ? '/services/' + serviceId : '/services';
        var method = serviceId ? 'PUT' : 'POST';

        var data = {
            name_ar: $('#name_ar').val(),
            name_en: $('#name_en').val(),
            description_ar: $('#description_ar').val(),
            description_en: $('#description_en').val(),
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
                    $('#serviceModal').modal('hide');
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

    // Delete service
    $('#servicesTable').on('click', '.btn-delete', function() {
        var serviceId = $(this).data('service-id');

        Swal.fire({
            title: 'هل أنت متأكد من حذف الخدمة؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/services/' + serviceId,
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
