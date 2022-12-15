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
        <div class="card">
            <div class="card-header">Monthly Earnings</div>
            <div class="card-body">
                <div class="table table-responsive">
                    {{-- <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Payment</td>
                                <th>Payment Date</th>
                                <td>First Name</td>
                                <td>Middle Name</td>
                                <td>Last Name</td>
                                <td>Email</td>
                                <td>Number</td>
                                <td>Reservation Date</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $data)
                                <tr>
                                    <td>{{ number_format($total_sales,2,".",",") }}</td>
                                    <td>{{ date('F j, Y', strtotime($data->payment_dates)) }}</td>
                                    <td>{{ $data->first_name }}</td>
                                    <td>{{ $data->middle_name }}</td>
                                    <td>{{ $data->last_name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->number }}</td>
                                    <td>{{ date('F j, Y', strtotime($data->date_from)) }}</td>
                                    <td>{{ date('F j, Y h:i a', strtotime($data->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Total Earnings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $data)
                                <tr>
                                    <td>
                                        @php
                                            $dateObj = DateTime::createFromFormat('!m', $data['month']);
                                            echo $monthName = $dateObj->format('F');
                                        @endphp
                                    </td>
                                    <td>{{ number_format($data['total_sales'], 2, '.', ',') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
