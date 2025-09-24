@extends('layouts.app')

@section('content')
<!-- Sidebar -->

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">{{ __('dashboard.welcome') }}</h2>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <!-- Users -->
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
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_users') }}</p>
                                        <span class="h3 mb-0">{{ $stats['total_users'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customers -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-success">
                                            <i class="fe fe-user-check fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_customers') }}</p>
                                        <span class="h3 mb-0">{{ $stats['total_customers'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-warning">
                                            <i class="fe fe-settings fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_services') }}</p>
                                        <span class="h3 mb-0">{{ $stats['total_services'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Revenue -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-info">
                                            <i class="fe fe-dollar-sign fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_revenue') }}</p>
                                        <span class="h3 mb-0">{{ number_format($stats['total_revenue'] ?? 0, 2) }} {{ __('dashboard.currency') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoices -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-secondary">
                                            <i class="fe fe-file-text fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_invoices') }}</p>
                                        <span class="h3 mb-0">{{ $stats['total_invoices'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Paid Invoices -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-success">
                                            <i class="fe fe-check-circle fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.paid_invoices') }}</p>
                                        <span class="h3 mb-0">{{ $stats['paid_invoices'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Invoices -->
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
                                        <p class="small text-muted mb-1">{{ __('dashboard.pending_invoices') }}</p>
                                        <span class="h3 mb-0">{{ $stats['pending_invoices'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Revenue Growth -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm {{ ($stats['revenue_growth'] ?? 0) >= 0 ? 'bg-success' : 'bg-danger' }}">
                                            <i class="fe fe-trending-{{ ($stats['revenue_growth'] ?? 0) >= 0 ? 'up' : 'down' }} fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.monthly_revenue_growth') }}</p>
                                        <span class="h3 mb-0">{{ number_format($stats['revenue_growth'] ?? 0, 1) }}{{ __('dashboard.percentage') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contacts -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary">
                                            <i class="fe fe-phone fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_contacts') }}</p>
                                        <span class="h3 mb-0">{{ $stats['total_contacts'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonials -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-info">
                                            <i class="fe fe-star fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_testimonials') }}</p>
                                        <span class="h3 mb-0">{{ $stats['total_testimonials'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Blogs -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-warning">
                                            <i class="fe fe-file fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_blogs') }}</p>
                                        <span class="h3 mb-0">{{ $stats['total_blogs'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Partners -->
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-secondary">
                                            <i class="fe fe-users fe-16 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-1">{{ __('dashboard.total_partners') }}</p>
                                        <span class="h3 mb-0">{{ $stats['total_partners'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row mb-4">
                    <!-- Monthly Revenue Chart -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">{{ __('dashboard.monthly_revenue') }}</strong>
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyRevenueChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Growth Chart -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">{{ __('dashboard.customer_growth') }}</strong>
                            </div>
                            <div class="card-body">
                                <canvas id="customerGrowthChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Services Distribution -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">{{ __('dashboard.services_distribution') }}</strong>
                            </div>
                            <div class="card-body">
                                <canvas id="servicesDistributionChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Status Distribution -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">{{ __('dashboard.invoice_status') }}</strong>
                            </div>
                            <div class="card-body">
                                <canvas id="invoiceStatusChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">{{ __('dashboard.recent_activities') }}</strong>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush my-n3">
                                    @if($stats['recent_activities'] && $stats['recent_activities']->count() > 0)
                                        @foreach($stats['recent_activities'] as $activity)
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        @if($activity->action == 'login')
                                                            <span class="fe fe-user fe-16 text-success"></span>
                                                        @elseif($activity->action == 'dashboard_action')
                                                            <span class="fe fe-activity fe-16 text-info"></span>
                                                        @else
                                                            <span class="fe fe-settings fe-16 text-muted"></span>
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        <small><strong>
                                                            @if($activity->action == 'login')
                                                                تم تسجيل دخول جديد
                                                            @elseif($activity->action == 'dashboard_action')
                                                                تم تنفيذ إجراء في لوحة التحكم
                                                            @else
                                                                {{ $activity->action }}
                                                            @endif
                                                        </strong></small>
                                                        <div class="my-0 text-muted small">
                                                            {{ $activity->created_at->diffForHumans() }}
                                                            @if($activity->user_id)
                                                                - المستخدم: {{ $activity->user_id }}
                                                            @endif
                                                        </div>
                                                        @if($activity->data)
                                                            <div class="my-0 text-muted small">
                                                                البيانات: {{ Str::limit($activity->data, 50) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <small class="text-muted">لا توجد أنشطة حديثة</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Quick Actions -->
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-target fe-16 text-muted"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong><a href="{{ route('company-goals.index') }}">{{ __('dashboard.manage_company_goals') }}</a></strong></small>
                                                <div class="my-0 text-muted small">{{ __('dashboard.add_edit_company_goals') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-users fe-16 text-muted"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong><a href="{{ route('customers.index') }}">{{ __('dashboard.manage_customers') }}</a></strong></small>
                                                <div class="my-0 text-muted small">{{ __('dashboard.view_manage_customer_data') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-file-text fe-16 text-muted"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong><a href="{{ route('invoices.index') }}">{{ __('dashboard.manage_invoices') }}</a></strong></small>
                                                <div class="my-0 text-muted small">{{ __('dashboard.view_manage_invoices_payments') }}</div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Dashboard specific JavaScript
    $(document).ready(function() {
        console.log('Dashboard loaded successfully');

        // Monthly Revenue Chart
        @if(isset($stats['monthly_revenue_chart']) && count($stats['monthly_revenue_chart']['labels']) > 0)
        const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
        new Chart(monthlyRevenueCtx, {
            type: 'line',
            data: {
                labels: @json($stats['monthly_revenue_chart']['labels']),
                datasets: [{
                    label: 'الإيرادات (ر.س)',
                    data: @json($stats['monthly_revenue_chart']['data']),
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: '{{ __("dashboard.monthly_revenue_last_6_months") }}'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' ر.س';
                            }
                        }
                    }
                }
            }
        });
        @endif

        // Customer Growth Chart
        @if(isset($stats['customer_growth_chart']) && count($stats['customer_growth_chart']['labels']) > 0)
        const customerGrowthCtx = document.getElementById('customerGrowthChart').getContext('2d');
        new Chart(customerGrowthCtx, {
            type: 'bar',
            data: {
                labels: @json($stats['customer_growth_chart']['labels']),
                datasets: [{
                    label: 'عدد العملاء الجدد',
                    data: @json($stats['customer_growth_chart']['data']),
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: '{{ __("dashboard.new_customer_growth_last_6_months") }}'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
        @endif

        // Services Distribution Chart
        @if(isset($stats['services_distribution']) && count($stats['services_distribution']['labels']) > 0)
        const servicesDistributionCtx = document.getElementById('servicesDistributionChart').getContext('2d');
        new Chart(servicesDistributionCtx, {
            type: 'doughnut',
            data: {
                labels: @json($stats['services_distribution']['labels']),
                datasets: [{
                    data: @json($stats['services_distribution']['data']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: '{{ __("dashboard.services_distribution") }}'
                    }
                }
            }
        });
        @endif

        // Invoice Status Distribution Chart
        @if(isset($stats['invoice_status_distribution']) && count($stats['invoice_status_distribution']['labels']) > 0)
        const invoiceStatusCtx = document.getElementById('invoiceStatusChart').getContext('2d');
        new Chart(invoiceStatusCtx, {
            type: 'pie',
            data: {
                labels: @json($stats['invoice_status_distribution']['labels']),
                datasets: [{
                    data: @json($stats['invoice_status_distribution']['data']),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)', // paid - green
                        'rgba(255, 205, 86, 0.8)', // pending - yellow
                        'rgba(255, 99, 132, 0.8)', // overdue - red
                        'rgba(54, 162, 235, 0.8)'  // other - blue
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: '{{ __("dashboard.invoice_status_distribution") }}'
                    }
                }
            }
        });
        @endif
    });
</script>
@endpush
@endsection
