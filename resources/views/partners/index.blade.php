@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">إدارة الشركاء</h2>

                <div class="mb-3">
                    <button id="btnAddPartner" class="btn btn-primary">
                        إضافة شريك جديد
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="partnersTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الشريك (عربي)</th>
                                    <th>اسم الشريك (إنجليزي)</th>
                                    <th>الصورة</th>
                                    <th>الرابط</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit Partner -->
                <div class="modal fade" id="partnerModal" tabindex="-1" role="dialog" aria-labelledby="partnerModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="partnerForm" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="partnerModalLabel">إضافة شريك</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="partnerId" name="partnerId" value="">
                                    <div class="form-group">
                                        <label for="name_ar">اسم الشريك (عربي)</label>
                                        <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_en">اسم الشريك (إنجليزي)</label>
                                        <input type="text" class="form-control" id="name_en" name="name_en" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">صورة الشريك (اختياري)</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        <small class="form-text text-muted">يُفضل صور بأبعاد 200x100 بكسل</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">رابط الشريك (اختياري)</label>
                                        <input type="url" class="form-control" id="link" name="link" placeholder="https://example.com">
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
    var table = $('#partnersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("partners.index") }}',
        columns: [
            { data: 'name_ar', name: 'name_ar' },
            { data: 'name_en', name: 'name_en' },
            {
                data: 'image',
                name: 'image',
                render: function(data, type, row) {
                    if (data) {
                        return '<img src="/' + data + '" alt="Partner Image" style="width: 50px; height: 30px; object-fit: cover;">';
                    }
                    return 'لا توجد صورة';
                }
            },
            {
                data: 'link',
                name: 'link',
                render: function(data, type, row) {
                    if (data) {
                        return '<a href="' + data + '" target="_blank" class="btn btn-sm btn-outline-primary">عرض</a>';
                    }
                    return 'لا يوجد رابط';
                }
            },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: 'ar.json'
        }
    });

    // Open modal for adding partner
    $('#btnAddPartner').click(function() {
        $('#partnerForm')[0].reset();
        $('#partnerId').val('');
        $('#partnerModalLabel').text('إضافة شريك');
        $('#partnerModal').modal('show');
    });

    // Open modal for editing partner
    $('#partnersTable').on('click', '.btn-edit', function() {
        var partnerId = $(this).data('partner-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#partnerForm')[0].reset();
        $('#partnerId').val(partnerId);
        $('#name_ar').val(rowData.name_ar);
        $('#name_en').val(rowData.name_en);
        $('#link').val(rowData.link);
        $('#partnerModalLabel').text('تعديل شريك');
        $('#partnerModal').modal('show');
    });

    // Submit form for add/edit partner
    $('#partnerForm').submit(function(e) {
        e.preventDefault();

        var partnerId = $('#partnerId').val();
        var url = partnerId ? '/partners/' + partnerId : '/partners';
        var method = partnerId ? 'PUT' : 'POST';

        var formData = new FormData(this);
        if (partnerId) {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'نجاح',
                    text: response.message,
                }).then(() => {
                    table.ajax.reload(null, false);
                    $('#partnerModal').modal('hide');
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

    // Delete partner
    $('#partnersTable').on('click', '.btn-delete', function() {
        var partnerId = $(this).data('partner-id');

        Swal.fire({
            title: 'هل أنت متأكد من حذف الشريك؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/partners/' + partnerId,
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
