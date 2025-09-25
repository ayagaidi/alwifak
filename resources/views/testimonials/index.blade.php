@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">{{ __('testimonials.manage_testimonials') }}</h2>

                <div class="mb-3">
                    <button id="btnAddTestimonial" class="btn btn-primary">
                        {{ __('testimonials.add_new_testimonial') }}
                    </button>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="testimonialsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ __('testimonials.name') }}</th>
                                    <th>{{ __('testimonials.message') }}</th>
                                    <th>{{ __('testimonials.rating') }}</th>
                                    <th>{{ __('testimonials.created_at') }}</th>
                                    <th>{{ __('testimonials.actions') }}</th>
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
                                <h5 class="modal-title" id="testimonialModalLabel">{{ __('testimonials.add_new_testimonial') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('testimonials.close') }}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="testimonialId" name="testimonialId" value="">
                                    <div class="form-group">
                                        <label for="name">{{ __('testimonials.name_required') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('testimonials.enter_customer_name') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">{{ __('testimonials.message_required') }}</label>
                                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="{{ __('testimonials.enter_testimonial_message') }}" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="rating">{{ __('testimonials.rating_required') }}</label>
                                        <select class="form-control" id="rating" name="rating" required>
                                            <option value="">{{ __('testimonials.choose_rating') }}</option>
                                            <option value="1">{{ __('testimonials.one_star') }}</option>
                                            <option value="2">{{ __('testimonials.two_stars') }}</option>
                                            <option value="3">{{ __('testimonials.three_stars') }}</option>
                                            <option value="4">{{ __('testimonials.four_stars') }}</option>
                                            <option value="5">{{ __('testimonials.five_stars') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('testimonials.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('testimonials.save_testimonial') }}</button>
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
var currentLocale = '{{ app()->getLocale() }}';

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
        language: currentLocale === 'ar' ? { url: 'ar.json' } : {}
    });

    // Open modal for adding testimonial
    $('#btnAddTestimonial').click(function() {
        $('#testimonialForm')[0].reset();
        $('#testimonialId').val('');
        $('#testimonialModalLabel').text('{{ __("testimonials.add_new_testimonial") }}');
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
        $('#testimonialModalLabel').text('{{ __("testimonials.edit_testimonial") }}');
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
                            title: '{{ __("testimonials.success") }}',
                            text: response.message,
                        }).then(() => {
                            table.ajax.reload(null, false);
                            $('#testimonialModal').modal('hide');
                        });
                    },
                    error: function(xhr) {
                        var errorMessage = '{{ __("testimonials.an_error_occurred") }}';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: '{{ __("testimonials.error") }}',
                            text: errorMessage,
                        });
                    }
                });
    });

    // Delete testimonial
    $('#testimonialsTable').on('click', '.btn-delete', function() {
        var testimonialId = $(this).data('testimonial-id');

        Swal.fire({
            title: '{{ __("testimonials.confirm_delete_testimonial") }}',
            text: "{{ __('testimonials.delete_warning') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{ __("testimonials.yes_delete") }}',
            cancelButtonText: '{{ __("testimonials.cancel") }}',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/testimonials/' + testimonialId,
                    method: 'DELETE',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ __("testimonials.success") }}',
                            text: response.message,
                        });
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        var errorMessage = '{{ __("testimonials.an_error_occurred") }}';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: '{{ __("testimonials.error") }}',
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
