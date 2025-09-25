@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">{{ __('company-goals.company_goals_management') }}</h2>

                <div class="mb-3">
                    <button id="btnAddCompanyGoal" class="btn btn-primary">
                        {{ __('company-goals.add_new_goal') }}
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="companyGoalsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ __('company-goals.title') }}</th>
                                    <th>{{ __('company-goals.title_en') }}</th>
                                    <th>{{ __('company-goals.description') }}</th>
                                    <th>{{ __('company-goals.description_en') }}</th>
                                    <th>{{ __('company-goals.created_at') }}</th>
                                    <th>{{ __('company-goals.actions') }}</th>
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
                                    <h5 class="modal-title" id="companyGoalModalLabel">{{ __('company-goals.add_company_goal') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('company-goals.close') }}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="companyGoalId" name="companyGoalId" value="">
                                    <div class="form-group">
                                        <label for="title">{{ __('company-goals.title') }}</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="title_en">{{ __('company-goals.title_en') }}</label>
                                        <input type="text" class="form-control" id="title_en" name="title_en" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('company-goals.description') }}</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_en">{{ __('company-goals.description_en') }}</label>
                                        <textarea class="form-control" id="description_en" name="description_en" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('company-goals.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('company-goals.save') }}</button>
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
var companyGoalsLang = {
    add_company_goal: '{{ __('company-goals.add_company_goal') }}',
    edit_company_goal: '{{ __('company-goals.edit_company_goal') }}',
    success: '{{ __('company-goals.success') }}',
    error: '{{ __('company-goals.error') }}',
    an_error_occurred: '{{ __('company-goals.an_error_occurred') }}',
    confirm_delete_company_goal: '{{ __('company-goals.confirm_delete_company_goal') }}',
    yes_delete: '{{ __('company-goals.yes_delete') }}',
    cancel: '{{ __('company-goals.cancel') }}'
};

$(document).ready(function() {
    var table = $('#companyGoalsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("company-goals.index") }}',
        columns: [
            { data: 'title', name: 'title' },
            { data: 'title_en', name: 'title_en' },
            { data: 'description', name: 'description' },
            { data: 'description_en', name: 'description_en' },
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
        $('#companyGoalModalLabel').text(companyGoalsLang.add_company_goal);
        $('#companyGoalModal').modal('show');
    });

    // Open modal for editing company goal
    $('#companyGoalsTable').on('click', '.btn-edit', function() {
        var companyGoalId = $(this).data('company-goal-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#companyGoalForm')[0].reset();
        $('#companyGoalId').val(companyGoalId);
        $('#title').val(rowData.title);
        $('#title_en').val(rowData.title_en);
        $('#description').val(rowData.description);
        $('#description_en').val(rowData.description_en);
        $('#companyGoalModalLabel').text(companyGoalsLang.edit_company_goal);
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
            title_en: $('#title_en').val(),
            description: $('#description').val(),
            description_en: $('#description_en').val(),
        };

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: companyGoalsLang.success,
                    text: response.message,
                }).then(() => {
                    table.ajax.reload(null, false);
                    $('#companyGoalModal').modal('hide');
                });
            },
            error: function(xhr) {
                var errorMessage = companyGoalsLang.an_error_occurred;
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: companyGoalsLang.error,
                    text: errorMessage,
                });
            }
        });
    });

    // Delete company goal
    $('#companyGoalsTable').on('click', '.btn-delete', function() {
        var companyGoalId = $(this).data('company-goal-id');

        Swal.fire({
            title: companyGoalsLang.confirm_delete_company_goal,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: companyGoalsLang.yes_delete,
            cancelButtonText: companyGoalsLang.cancel,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/company-goals/' + companyGoalId,
                    method: 'DELETE',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: companyGoalsLang.success,
                            text: response.message,
                        });
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        var errorMessage = companyGoalsLang.an_error_occurred;
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: companyGoalsLang.error,
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
