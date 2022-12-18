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
        <div class="col-md-6">
            <div class="card" style="margin-bottom: 20px;">
                <div class="card-header">Monthly Earnings</div>
                <div class="card-body">
                    <div class="table table-responsive">
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Monthly Cancellations</div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Total Cancelled</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($cancelled_month); $i++)
                                    <tr>
                                        <td>
                                            @php
                                                $dateObj = DateTime::createFromFormat('!m', $cancelled_month[$i]);
                                                echo $monthName = $dateObj->format('F');
                                            @endphp
                                        </td>
                                        <td>{{ $cancelled_month_count[$i] }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
