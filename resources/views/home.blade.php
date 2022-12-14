@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

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

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ url('monthly_earning_report') }}">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)
                                </div>

                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ url('yearly_earning_report') }}">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)
                                </div>

                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Monthly Count</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reserved_monthly }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Yearly Count</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reserved_yearly }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        @foreach ($reservation_month as $data_month)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        @php
                            $dateObj = DateTime::createFromFormat('!m', $data_month->month);
                            echo $monthName = $dateObj->format('F') . ' ' . $data_month->year;
                        @endphp
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>Name</th>
                                <th>Date of Transaction</th>
                                <th>Date of Reservation</th>
                            </thead>
                            <tbody>
                                @foreach ($reservations[$data_month->month] as $data)
                                    <tr>
                                        <td>{{ $data->first_name . ' ' . $data->middle_name . ' ' . $data->last_name }}</td>
                                        <td>{{ date('F j, Y', strtotime($data->date)) }}</td>
                                        <td>{{ date('F j, Y', strtotime($data->date_from)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
