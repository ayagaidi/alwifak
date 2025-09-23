@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">إدارة الشهادات</h2>

                <div class="mb-3">
                    <button id="btnAddTestimonial" class="btn btn-primary">
                        إضافة شهادة جديدة
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="testimonialsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الرسالة</th>
                                    <th>التقييم</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit Testimonial -->
                <div class="modal fade" id="testimonialModal" tabindex="-1" role="dialog" aria-labelledby="testimonialModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="testimonialForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="testimonialModalLabel">إضافة شهادة جديدة</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="testimonialId" name="testimonialId" value="">
                                    <div class="form-group">
                                        <label for="name">الاسم *</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسم العميل" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">الرسالة *</label>
                                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="أدخل رسالة الشهادة" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="rating">التقييم *</label>
                                        <select class="form-control" id="rating" name="rating" required>
                                            <option value="">اختر التقييم</option>
                                            <option value="1">نجمة واحدة</option>
                                            <option value="2">نجمتان</option>
                                            <option value="3">ثلاث نجوم</option>
                                            <option value="4">أربع نجوم</option>
                                            <option value="5">خمس نجوم</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                    <button type="submit" class="btn btn-primary">حفظ الشهادة</button>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#testimonialsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("testimonials.index") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'message_preview', name: 'message_preview' },
            { data: 'rating_stars', name: 'rating_stars', orderable: false, searchable: false },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
        }
    });

    // Open modal for adding testimonial
    $('#btnAddTestimonial').click(function() {
        $('#testimonialForm')[0].reset();
        $('#testimonialId').val('');
        $('#testimonialModalLabel').text('إضافة شهادة جديدة');
        $('#testimonialModal').modal('show');
    });

    // Open modal for editing testimonial
    $('#testimonialsTable').on('click', '.btn-edit', function() {
        var testimonialId = $(this).data('testimonial-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#testimonialForm')[0].reset();
        $('#testimonialId').val(testimonialId);
        $('#name').val(rowData.name);
        $('#message').val(rowData.message);
        $('#rating').val(rowData.rating);
        $('#testimonialModalLabel').text('تعديل الشهادة');
        $('#testimonialModal').modal('show');
    });

    // Submit form for add/edit testimonial
    $('#testimonialForm').submit(function(e) {
        e.preventDefault();

        var testimonialId = $('#testimonialId').val();
        var url = testimonialId ? '/testimonials/' + testimonialId : '/testimonials';
        var method = testimonialId ? 'PUT' : 'POST';

        var data = {
            name: $('#name').val(),
            message: $('#message').val(),
            rating: $('#rating').val(),
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
                    $('#testimonialModal').modal('hide');
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

    // Delete testimonial
    $('#testimonialsTable').on('click', '.btn-delete', function() {
        var testimonialId = $(this).data('testimonial-id');

        Swal.fire({
            title: 'هل أنت متأكد من حذف هذه الشهادة؟',
            text: "لا يمكن التراجع عن هذا الإجراء.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/testimonials/' + testimonialId,
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
