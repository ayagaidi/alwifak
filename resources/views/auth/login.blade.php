@extends('auth.app')

@section('content')
<div class="row align-items-center vh-100">
    <div class="col-lg-4 col-md-5 col-11 mx-auto">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <a class="navbar-brand mx-auto" href="{{ url('/') }}">
                        <img src="{{ asset('logo.svg') }}" alt="{{ __('auth.login') }} Logo" class="navbar-brand-img brand-md">
                    </a>
                    <h1 class="h4 mb-3">{{ __('auth.login') }}</h1>
                </div>

                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">{{ __('auth.email') }}</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('auth.email') }}" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">{{ __('auth.password') }}</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('auth.password') }}" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="text-end mt-1">
                            <a href="{{ route('password.request') }}" class="text-muted small">{{ __('auth.forgot_password') }}</a>
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('auth.remember_me') }}
                        </label>
                    </div>

                    <button class="btn btn-lg btn-primary w-100" type="submit">{{ __('auth.login_button') }}</button>
                </form>

                <div class="text-center mt-4">
                    <x-language-switcher />
                </div>

                <p class="mt-4 mb-0 text-muted text-center">© {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Bootstrap form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // SweetAlert for session messages
    @if(session('status'))
        Swal.fire({
            icon: 'success',
            title: 'نجاح',
            text: '{{ session('status') }}',
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'خطأ',
            text: '{{ $errors->first() }}',
        });
    @endif
</script>
@endpush
@endsection
