@extends('auth.app')

@section('content')
<div class="row align-items-center vh-100">
    <form method="POST" action="{{ route('login') }}" class="col-lg-3 col-md-4 col-10 mx-auto text-center needs-validation" novalidate>
        @csrf
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="navbar-brand-img brand-md">
        </a>
        <h1 class="h6 mb-3">تسجيل الدخول</h1>

        <div class="form-group">
            <label for="email" class="sr-only">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="sr-only">كلمة المرور</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="كلمة المرور" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> تذكرني
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">دخول</button>

        <p class="mt-5 mb-3 text-muted">© 2020</p>
    </form>
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
