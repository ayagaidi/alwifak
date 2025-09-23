@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">إدارة بيانات الاتصال</h2>

                @if($contactExists)
                <div class="alert alert-info" role="alert">
                    <i class="fe fe-info fe-16"></i>
                    يمكنك إدارة بيانات الاتصال الخاصة بك من خلال تعديل السجل الموجود أدناه.
                </div>
                @endif

                <div class="mb-3">
                    @if(!$contactExists)
                    <button id="btnAddContact" class="btn btn-primary">
                        إضافة بيانات اتصال جديدة
                    </button>
                    @endif
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="contactsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>رقم الهاتف</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>العنوان</th>
                                    <th>روابط التواصل</th>
                                    <th>تطبيقات المراسلة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit Contact -->
                <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="contactForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contactModalLabel">
                                        @if($contactExists)
                                            تعديل بيانات الاتصال
                                        @else
                                            إضافة بيانات اتصال
                                        @endif
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="contactId" name="contactId" value="">
                                    <div class="form-group">
                                        <label for="phone">رقم الهاتف (اختياري)</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="مثال: +966501234567">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">البريد الإلكتروني (اختياري)</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="مثال: info@company.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">العنوان (اختياري)</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="العنوان الكامل"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="facebook_url">رابط فيسبوك (اختياري)</label>
                                        <input type="url" class="form-control" id="facebook_url" name="facebook_url" placeholder="https://facebook.com/username">
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter_url">رابط تويتر (اختياري)</label>
                                        <input type="url" class="form-control" id="twitter_url" name="twitter_url" placeholder="https://twitter.com/username">
                                    </div>
                                    <div class="form-group">
                                        <label for="linkedin_url">رابط لينكد إن (اختياري)</label>
                                        <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" placeholder="https://linkedin.com/in/username">
                                    </div>
                                    <div class="form-group">
                                        <label for="youtube_url">رابط يوتيوب (اختياري)</label>
                                        <input type="url" class="form-control" id="youtube_url" name="youtube_url" placeholder="https://youtube.com/channel/username">
                                    </div>
                                    <div class="form-group">
                                        <label for="instagram_url">رابط إنستغرام (اختياري)</label>
                                        <input type="url" class="form-control" id="instagram_url" name="instagram_url" placeholder="https://instagram.com/username">
                                    </div>
                                    <div class="form-group">
                                        <label for="website_url">رابط الموقع (اختياري)</label>
                                        <input type="url" class="form-control" id="website_url" name="website_url" placeholder="https://website.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="whatsapp">رقم الواتساب (اختياري)</label>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="مثال: +966501234567">
                                    </div>
                                    <div class="form-group">
                                        <label for="telegram">معرف التليجرام (اختياري)</label>
                                        <input type="text" class="form-control" id="telegram" name="telegram" placeholder="مثال: @username">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                    <button type="submit" class="btn btn-primary">
                                        @if($contactExists)
                                            تحديث
                                        @else
                                            حفظ
                                        @endif
                                    </button>
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
    var table = $('#contactsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("contacts.index") }}',
        columns: [
            { data: 'phone', name: 'phone' },
            { data: 'email', name: 'email' },
            { data: 'address', name: 'address' },
            { data: 'social_links', name: 'social_links', orderable: false, searchable: false },
            { data: 'messaging', name: 'messaging', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: 'ar.json'
        }
    });

    // Open modal for adding contact
    $('#btnAddContact').click(function() {
        $('#contactForm')[0].reset();
        $('#contactId').val('');
        $('#contactModalLabel').text('إضافة بيانات اتصال');
        $('#contactModal').modal('show');
    });

    // Auto-open edit modal if contact exists
    @if($contactExists)
    $(document).ready(function() {
        var firstRow = $('#contactsTable tbody tr:first');
        if (firstRow.length) {
            firstRow.find('.btn-edit').click();
        }
    });
    @endif

    // Open modal for editing contact
    $('#contactsTable').on('click', '.btn-edit', function() {
        var contactId = $(this).data('contact-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#contactForm')[0].reset();
        $('#contactId').val(contactId);
        $('#phone').val(rowData.phone);
        $('#email').val(rowData.email);
        $('#address').val(rowData.address);
        $('#facebook_url').val(rowData.facebook_url);
        $('#twitter_url').val(rowData.twitter_url);
        $('#linkedin_url').val(rowData.linkedin_url);
        $('#youtube_url').val(rowData.youtube_url);
        $('#instagram_url').val(rowData.instagram_url);
        $('#website_url').val(rowData.website_url);
        $('#whatsapp').val(rowData.whatsapp);
        $('#telegram').val(rowData.telegram);
        $('#contactModalLabel').text('تعديل بيانات الاتصال');
        $('#contactModal').modal('show');
    });

    // Submit form for add/edit contact
    $('#contactForm').submit(function(e) {
        e.preventDefault();

        var contactId = $('#contactId').val();
        var url = contactId ? '/contacts/' + contactId : '/contacts';
        var method = contactId ? 'PUT' : 'POST';

        var data = {
            phone: $('#phone').val(),
            email: $('#email').val(),
            address: $('#address').val(),
            facebook_url: $('#facebook_url').val(),
            twitter_url: $('#twitter_url').val(),
            linkedin_url: $('#linkedin_url').val(),
            youtube_url: $('#youtube_url').val(),
            instagram_url: $('#instagram_url').val(),
            website_url: $('#website_url').val(),
            whatsapp: $('#whatsapp').val(),
            telegram: $('#telegram').val(),
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
                    $('#contactModal').modal('hide');
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

    // Delete contact
    $('#contactsTable').on('click', '.btn-delete', function() {
        var contactId = $(this).data('contact-id');

        Swal.fire({
            title: 'هل أنت متأكد من حذف بيانات الاتصال؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/contacts/' + contactId,
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
