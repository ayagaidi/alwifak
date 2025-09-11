@extends('layouts.app')

@section('content')
<!-- Sidebar -->

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">مرحباً بك في لوحة التحكم!</h2>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary">
                                            <i class="fe fe-users fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">إجمالي المستخدمين</p>
                                        <span class="h3 mb-0">{{ $stats['total_users'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-success">
                                            <i class="fe fe-activity fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">الجلسات النشطة</p>
                                        <span class="h3 mb-0">{{ $stats['active_sessions'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-warning">
                                            <i class="fe fe-clock fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">الأنشطة اليومية</p>
                                        <span class="h3 mb-0">{{ $stats['recent_activities'] ? count($stats['recent_activities']) : 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-info">
                                            <i class="fe fe-bar-chart-2 fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">التقارير</p>
                                        <span class="h3 mb-0">12</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">الأنشطة الأخيرة</strong>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush my-n3">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-user fe-16 text-muted"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>تم تسجيل دخول جديد</strong></small>
                                                <div class="my-0 text-muted small">منذ 5 دقائق</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-settings fe-16 text-muted"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>تم تحديث الإعدادات</strong></small>
                                                <div class="my-0 text-muted small">منذ 10 دقائق</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    // Dashboard specific JavaScript
    $(document).ready(function() {
        // Add any dashboard-specific functionality here
        console.log('Dashboard loaded successfully');
    });
</script>
@endpush
@endsection
