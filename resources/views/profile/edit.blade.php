@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">تعديل الملف الشخصي</h2>

                <!-- Profile Information Card -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">معلومات الملف الشخصي</h6>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Password Update Card -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">تحديث كلمة المرور</h6>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

               

            </div>
        </div>
    </div>
</main>
@endsection

