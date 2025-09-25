@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">{{ __('partners.partners_management') }}</h2>

                <div class="mb-3">
                    <button id="btnAddPartner" class="btn btn-primary">
                        {{ __('partners.add_new_partner') }}
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="partnersTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ __('partners.partner_name_arabic') }}</th>
                                    <th>{{ __('partners.partner_name_english') }}</th>
                                    <th>{{ __('partners.image') }}</th>
                                    <th>{{ __('partners.link') }}</th>
                                    <th>{{ __('partners.actions') }}</th>
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
                                    <h5 class="modal-title" id="partnerModalLabel">{{ __('partners.add_partner') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('partners.close') }}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="partnerId" name="partnerId" value="">
                                    <div class="form-group">
                                        <label for="name_ar">{{ __('partners.name_ar') }}</label>
                                        <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_en">{{ __('partners.name_en') }}</label>
                                        <input type="text" class="form-control" id="name_en" name="name_en" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">{{ __('partners.partner_image_optional') }}</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        <small class="form-text text-muted">{{ __('partners.preferred_dimensions') }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">{{ __('partners.partner_link_optional') }}</label>
                                        <input type="url" class="form-control" id="link" name="link" placeholder="{{ __('partners.example_link') }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('partners.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('partners.save') }}</button>
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
var currentLocale = '{{ app()->getLocale() }}';

var partnersLang = {
    add_partner: '{{ __("partners.add_partner") }}',
    edit_partner: '{{ __("partners.edit_partner") }}',
    success: '{{ __("partners.success") }}',
    error: '{{ __("partners.error") }}',
    an_error_occurred: '{{ __("partners.an_error_occurred") }}',
    confirm_delete_partner: '{{ __("partners.confirm_delete_partner") }}',
    yes_delete: '{{ __("partners.yes_delete") }}',
    cancel: '{{ __("partners.cancel") }}',
    save: '{{ __("partners.save") }}',
    no_image: '{{ __("partners.no_image") }}',
    no_link: '{{ __("partners.no_link") }}',
    view: '{{ __("partners.view") }}',
};

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
                    return partnersLang.no_image;
                }
            },
            {
                data: 'link',
                name: 'link',
                render: function(data, type, row) {
                    if (data) {
                        return '<a href="' + data + '" target="_blank" class="btn btn-sm btn-outline-primary">' + partnersLang.view + '</a>';
                    }
                    return partnersLang.no_link;
                }
            },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: currentLocale === 'ar' ? { url: 'ar.json' } : {}
    });

    // Open modal for adding partner
    $('#btnAddPartner').click(function() {
        $('#partnerForm')[0].reset();
        $('#partnerId').val('');
        $('#partnerModalLabel').text(partnersLang.add_partner);
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
        $('#partnerModalLabel').text(partnersLang.edit_partner);
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
                    title: partnersLang.success,
                    text: response.message,
                }).then(() => {
                    table.ajax.reload(null, false);
                    $('#partnerModal').modal('hide');
                });
            },
            error: function(xhr) {
                var errorMessage = partnersLang.an_error_occurred;
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: partnersLang.error,
                    text: errorMessage,
                });
            }
        });
    });

    // Delete partner
    $('#partnersTable').on('click', '.btn-delete', function() {
        var partnerId = $(this).data('partner-id');

        Swal.fire({
            title: partnersLang.confirm_delete_partner,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: partnersLang.yes_delete,
            cancelButtonText: partnersLang.cancel,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/partners/' + partnerId,
                    method: 'DELETE',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: partnersLang.success,
                            text: response.message,
                        });
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        var errorMessage = partnersLang.an_error_occurred;
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: partnersLang.error,
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
