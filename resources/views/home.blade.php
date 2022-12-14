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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('monthly_earning_report') }}">₱
                                    {{ number_format($reservation_monthly, 2, '.', ',') }}</a>
                            </div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('yearly_earning_report') }}">₱
                                    {{ number_format($reservation_yearly, 2, '.', ',') }}</a>
                            </div>
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

        <!-- Content Column -->
        <div class="col-lg-12 mb-12">

            <!-- Project Card Example -->
            <div class="card shadow mb-12">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upcoming Customers</h6>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    {{-- <td>Payment</td> --}}
                                    <td>Status</td>
                                    <td>First Name</td>
                                    <td>Middle Name</td>
                                    <td>Last Name</td>
                                    <td>Email</td>
                                    <td>Number</td>
                                    {{-- <td>Receipt</td> --}}
                                    <td>Reservation Date</td>
                                    <td>Date</td>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                @foreach ($reservations as $data)
                                    <tr>
                                        {{-- <td>
                                            ₱{{ number_format($data->payment, 2, '.', ',') }}
                                        </td> --}}
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->first_name }}</td>
                                        <td>{{ $data->middle_name }}</td>
                                        <td>{{ $data->last_name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->number }}</td>

                                        <td>{{ date('F j, Y', strtotime($data->date_from)) }}</td>

                                        {{-- <td>{{ $data->date_to }}</td> --}}
                                        <td>{{ date('F j, Y h:i a', strtotime($data->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>
@endsection
