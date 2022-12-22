@extends('layouts.admin')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Paid</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <h1> {{ $reservation_paid }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Reserved Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{-- <a href="{{ url('monthly_earning_report') }}">₱
                                    {{ number_format($reservation_monthly, 2, '.', ',') }}</a> --}}
                                <h1>{{ $reservation_reserved }}</h1>
                            </div>
                        </div>
                        {{-- <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Amount</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <h1>
                                    ₱ {{ number_format(6000 * $reservation_paid, 2, '.', ',') }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="margin-bottom: 20px;">
                <div class="card-header">Monthly Earnings</div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Customer</th>
                                    <th>Reservation Date</th>
                                    <th>Status</th>
                                    <th>Total Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $data)
                                    <tr>
                                        <td>
                                            {{ date('F', strtotime($data->created_at)) }}
                                            {{-- @php
                                                $dateObj = DateTime::createFromFormat('!m', $data->created_at);
                                                echo $monthName = $dateObj->format('F');
                                            @endphp --}}
                                        </td>

                                        <td>{{ $data->first_name . ' ' . $data->middle_name . ' ' . $data->last_name }}</td>
                                        <td>{{ date('F j, Y', strtotime($data->date_from)) }}</td>
                                        <td>
                                            @if ($data->reservation_latest)
                                                <span
                                                    class="badge badge-success btn-block">{{ $data->reservation_latest->status }}</span>
                                            @else
                                                None
                                            @endif
                                        </td>
                                        <td>₱ {{ number_format($total[$data->id], 2, '.', ',') }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Monthly Cancellations</div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Count</th>
                                    <th>Total Compensation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cancelled as $data)
                                    <tr>
                                        <td>{{ date('F j, Y', strtotime($data->date)) }}</td>
                                        <td>{{ $data->count }}</td>
                                        <td>₱ {{ number_format($data->count * 500, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
