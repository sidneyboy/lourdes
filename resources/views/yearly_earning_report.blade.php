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

    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Yearly Earnings</div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Sales</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $data)
                                <tr>
                                    <td>{{ $data->year }}</td>
                                    <td>{{ $data->total_sales + $data->downpayment }}</td>
                                    <td><a href="{{ url('yearly_earning_view_sales_report',['year' => $data->year]) }}" target="_blank">View Sales Report</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
