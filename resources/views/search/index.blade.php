@extends('layouts.app')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('dashboard.search_results_for') }} "{{ $query }}"</h3>
                </div>
                <div class="card-body">
                    @if(empty($results) || !array_filter($results, fn($items) => $items->count() > 0))
                        <p>{{ __('dashboard.no_results_found') }}</p>
                    @else
                        @foreach($results as $key => $items)
                            @if($items->count() > 0)
                                <h4>{{ ucfirst(str_replace('_', ' ', $key)) }}</h4>
                                <ul class="list-group mb-3">
                                    @foreach($items as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                @switch($key)
                                                    @case('users')
                                                        {{ $item->name }} ({{ $item->email }})
                                                        @break
                                                    @case('customers')
                                                        {{ $item->name }} - {{ $item->company ?? '' }} ({{ $item->email }})
                                                        @break
                                                    @case('services')
                                                        {{ app()->getLocale() === 'ar' ? $item->name_ar : $item->name_en }}
                                                        @break
                                                    @case('blogs')
                                                        {{ app()->getLocale() === 'ar' ? $item->title_ar : $item->title_en }}
                                                        @break
                                                    @case('contacts')
                                                        {{ $item->email }} - {{ Str::limit($item->address ?? '', 50) }}
                                                        @break
                                                    @case('testimonials')
                                                        {{ $item->name }}: {{ Str::limit($item->message, 50) }}
                                                        @break
                                                    @case('invoices')
                                                        #{{ $item->invoice_number }} - {{ $item->total_amount }} {{ __('dashboard.currency') }}
                                                        @break
                                                    @case('partners')
                                                        {{ app()->getLocale() === 'ar' ? $item->name_ar : $item->name_en }}
                                                        @break
                                                    @case('company_goals')
                                                        {{ app()->getLocale() === 'ar' ? $item->title : $item->title_en }}
                                                        @break
                                                    @default
                                                        {{ $item->name ?? $item->title ?? 'Item' }}
                                                @endswitch
                                            </span>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
