@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">إدارة أهداف الشركة</h2>

                <div class="mb-3">
                    <button id="btnAddCompanyGoal" class="btn btn-primary">
                        إضافة هدف جديد
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="companyGoalsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>عنوان الهدف</th>
                                    <th>الوصف</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit Company Goal -->
                <div class="modal fade" id="companyGoalModal" tabindex="-1" role="dialog" aria-labelledby="companyGoalModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="companyGoalForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="companyGoalModalLabel">إضافة هدف</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="companyGoalId" name="companyGoalId" value="">
                                    <div class="form-group">
                                        <label for="title">عنوان الهدف</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">الوصف</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
    var table = $('#companyGoalsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("company-goals.index") }}',
        columns: [
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: 'ar.json'
        }
    });

    // Open modal for adding company goal
    $('#btnAddCompanyGoal').click(function() {
        $('#companyGoalForm')[0].reset();
        $('#companyGoalId').val('');
        $('#companyGoalModalLabel').text('إضافة هدف');
        $('#companyGoalModal').modal('show');
    });

    // Open modal for editing company goal
    $('#companyGoalsTable').on('click', '.btn-edit', function() {
        var companyGoalId = $(this).data('company-goal-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#companyGoalForm')[0].reset();
        $('#companyGoalId').val(companyGoalId);
        $('#title').val(rowData.title);
        $('#description').val(rowData.description);
        $('#companyGoalModalLabel').text('تعديل هدف');
        $('#companyGoalModal').modal('show');
    });

    // Submit form for add/edit company goal
    $('#companyGoalForm').submit(function(e) {
        e.preventDefault();

        var companyGoalId = $('#companyGoalId').val();
        var url = companyGoalId ? '/company-goals/' + companyGoalId : '/company-goals';
        var method = companyGoalId ? 'PUT' : 'POST';

        var data = {
            title: $('#title').val(),
            description: $('#description').val(),
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
                    $('#companyGoalModal').modal('hide');
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

    // Delete company goal
    $('#companyGoalsTable').on('click', '.btn-delete', function() {
        var companyGoalId = $(this).data('company-goal-id');

        Swal.fire({
            title: 'هل أنت متأكد من حذف الهدف؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/company-goals/' + companyGoalId,
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
