@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">{{ __('users.users_management') }}</h2>

                <div class="mb-3">
                    <button id="btnAddUser" class="btn btn-primary">
                        {{ __('users.add_user') }}
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="usersTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ __('users.name') }}</th>
                                    <th>{{ __('users.email') }}</th>
                                    <th>{{ __('users.status') }}</th>
                                    <th>{{ __('users.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Add/Edit User -->
                <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="userForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel">{{ __('users.add_user') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('users.cancel') }}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="userId" name="userId" value="">
                                    <div class="form-group">
                                        <label for="name">{{ __('users.name') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('users.email') }}</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group password-group">
                                        <label for="password">{{ __('users.password') }}</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group password-group">
                                        <label for="password_confirmation">{{ __('users.confirm_password') }}</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('users.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('users.save') }}</button>
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
    var table = $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("users.index") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: '{{ app()->getLocale() === "ar" ? "ar.json" : "en.json" }}'
        }
    });

    // Open modal for adding user
    $('#btnAddUser').click(function() {
        $('#userForm')[0].reset();
        $('#userId').val('');
        $('#userModalLabel').text('{{ __("users.add_user") }}');
        $('.password-group').show();
        $('#userModal').modal('show');
    });

    // Open modal for editing user
    $('#usersTable').on('click', '.btn-edit', function() {
        var userId = $(this).data('user-id');
        var rowData = table.row($(this).parents('tr')).data();

        $('#userForm')[0].reset();
        $('#userId').val(userId);
        $('#name').val(rowData.name);
        $('#email').val(rowData.email);
        $('#userModalLabel').text('{{ __("users.edit_user") }}');
        $('.password-group').hide();
        $('#userModal').modal('show');
    });

    // Submit form for add/edit user
    $('#userForm').submit(function(e) {
        e.preventDefault();

        var userId = $('#userId').val();
        var url = userId ? '/users/' + userId : '/users';
        var method = userId ? 'PUT' : 'POST';

        var data = {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
        };

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: '{{ __("users.user_created") }}',
                    text: response.message,
                }).then(() => {
                    table.ajax.reload(null, false);
                    $('#userModal').modal('hide');
                });
            },
            error: function(xhr) {
                var errorMessage = '{{ __("users.user_not_found") }}';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("users.error") }}',
                    text: errorMessage,
                });
            }
        });
    });

    // Delete user
    $('#usersTable').on('click', '.btn-delete', function() {
        var userId = $(this).data('user-id');

        Swal.fire({
            title: 'هل أنت متأكد من حذف المستخدم؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/users/' + userId,
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

    // Toggle active/inactive user
    $('#usersTable').on('click', '.btn-toggle-active', function() {
        var userId = $(this).data('user-id');

        $.ajax({
            url: '/users/' + userId + '/toggle-active',
            method: 'POST',
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
    });
});
</script>
@endpush
