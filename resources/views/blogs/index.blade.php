@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">إدارة المقالات</h2>

                <div class="mb-3">
                    <button id="btnAddBlog" class="btn btn-primary">
                        إضافة مقالة جديدة
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="blogsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>عنوان المقالة</th>
                                    <th>الكاتب</th>
                                    <th>الحالة</th>
                                    <th>تاريخ النشر</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit Blog -->
                <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form id="blogForm" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="blogModalLabel">إضافة مقالة</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="blogId" name="blogId" value="">

                                    <!-- Arabic Section -->
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">النسخة العربية</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title_ar">عنوان المقالة (عربي)</label>
                                                <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="content_ar">محتوى المقالة (عربي)</label>
                                                <textarea class="form-control" id="content_ar" name="content_ar" rows="8" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="excerpt_ar">مقتطف المقالة (عربي) (اختياري)</label>
                                                <textarea class="form-control" id="excerpt_ar" name="excerpt_ar" rows="3" maxlength="500"></textarea>
                                                <small class="form-text text-muted">أقصى 500 حرف</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- English Section -->
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">English Version</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title_en">Article Title (English)</label>
                                                <input type="text" class="form-control" id="title_en" name="title_en" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="content_en">Article Content (English)</label>
                                                <textarea class="form-control" id="content_en" name="content_en" rows="8" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="excerpt_en">Article Excerpt (English) (Optional)</label>
                                                <textarea class="form-control" id="excerpt_en" name="excerpt_en" rows="3" maxlength="500"></textarea>
                                                <small class="form-text text-muted">Maximum 500 characters</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status and Publishing -->
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">حالة النشر</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="status">الحالة</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="draft">مسودة</option>
                                                    <option value="published">منشور</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="published_at">تاريخ النشر (اختياري)</label>
                                                <input type="datetime-local" class="form-control" id="published_at" name="published_at">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">صورة المقالة (اختياري)</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="image">اختر صورة</label>
                                                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                                                <small class="form-text text-muted">الصيغ المدعومة: JPEG, PNG, JPG, GIF (أقصى 2MB)</small>
                                            </div>
                                            <div id="imagePreview" class="mt-2" style="display: none;">
                                                <img id="previewImg" src="" alt="معاينة الصورة" style="max-width: 200px; max-height: 200px;" class="img-thumbnail">
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
    var table = $('#blogsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("blogs.index") }}',
        columns: [
            { data: 'title', name: 'title' },
            { data: 'author_name', name: 'author_name' },
            { data: 'status_badge', name: 'status_badge' },
            { data: 'published_at', name: 'published_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: 'ar.json'
        }
    });

    // Image preview functionality
    $('#image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
                $('#imagePreview').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#imagePreview').hide();
        }
    });

    // Open modal for adding blog
    $('#btnAddBlog').click(function() {
        $('#blogForm')[0].reset();
        $('#blogId').val('');
        $('#blogModalLabel').text('إضافة مقالة');
        $('#imagePreview').hide();
        $('#blogModal').modal('show');
    });

    // Open modal for editing blog
    $('#blogsTable').on('click', '.btn-edit', function() {
        var blogId = $(this).data('blog-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#blogForm')[0].reset();
        $('#blogId').val(blogId);
        $('#title_ar').val(rowData.title_ar);
        $('#title_en').val(rowData.title_en);
        $('#content_ar').val(rowData.content_ar);
        $('#content_en').val(rowData.content_en);
        $('#excerpt_ar').val(rowData.excerpt_ar);
        $('#excerpt_en').val(rowData.excerpt_en);
        $('#status').val(rowData.status);
        $('#published_at').val(rowData.published_at_formatted);
        $('#blogModalLabel').text('تعديل مقالة');
        $('#imagePreview').hide();
        $('#blogModal').modal('show');
    });

    // Submit form for add/edit blog
    $('#blogForm').submit(function(e) {
        e.preventDefault();

        var blogId = $('#blogId').val();
        var url = blogId ? '/blogs/' + blogId : '/blogs';
        var method = blogId ? 'PUT' : 'POST';

        var formData = new FormData(this);

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
                    $('#blogModal').modal('hide');
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

    // Delete blog
    $('#blogsTable').on('click', '.btn-delete', function() {
        var blogId = $(this).data('blog-id');

        Swal.fire({
            title: 'هل أنت متأكد من حذف المقالة؟',
            text: 'سيتم حذف المقالة وجميع الملفات المرتبطة بها',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/blogs/' + blogId,
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
