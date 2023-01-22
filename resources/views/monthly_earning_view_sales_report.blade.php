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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $monthName }} Earning Report</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Downpayment</th>
                                        <th>Full Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $data)
                                        <tr>
                                            <td>{{ date('F j, Y', strtotime($data->date)) }}</td>
                                            <td>{{ $data->downpayment }}
                                                @php
                                                    $down_sum[] = $data->downpayment;
                                                @endphp
                                            </td>
                                            <td>{{ $data->total_sales }}
                                                @php
                                                    $sales_sum[] = $data->total_sales;
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>Total</td>
                                        <td>{{ array_sum($down_sum) }}</td>
                                        <td>{{ array_sum($sales_sum) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Count</th>
                                        <th>Compensation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($cancelled) != 0)
                                        @foreach ($cancelled as $data)
                                            <tr>
                                                <td>{{ date('F j, Y', strtotime($data->date)) }}</td>
                                                <td>{{ $data->count }}
                                                    @php
                                                        $count_sum[] = $data->count;
                                                    @endphp
                                                </td>
                                                <td>
                                                    {{ $data->count * 500 }}
                                                    @php
                                                        $sum_total_count[] = $data->count * 500;
                                                    @endphp
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>Total</td>
                                            <td>{{ array_sum($count_sum) }}</td>
                                            <td>{{ array_sum($sum_total_count) }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Count</th>
                                        <th>{{ (array_sum($sales_sum) + array_sum($down_sum))/6000 }}</th>
                                        {{-- <th>{{ round(array_sum($sales_sum) + array_sum($down_sum) / 6000,2) }}</th> --}}
                                    </tr>
                                    <tr>
                                        <th>Forecasted</th>
                                        <th>
                                            @php
                                                echo $forescasted = (array_sum($down_sum) / 500) * 6000;
                                            @endphp
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('monthly_earning_report_print',['month' => $month]) }}" target="_blank" class="btn float-right btn-info">Print</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $("#monthly_earning_proceed").on('submit', (function(e) {
            e.preventDefault();
            $('.loading').show();
            $.ajax({
                url: "monthly_earning_proceed",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();
                    $('#monthly_earning_proceed_page').html(data);
                },
            });
        }));
    </script>
@endsection
