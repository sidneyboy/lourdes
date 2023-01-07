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
                <div class="card-header">{{ $year }} Earning Report</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Remittance</th>
                                        @foreach ($sales as $data)
                                            <th>
                                                @php
                                                    $dateObj = DateTime::createFromFormat('!m', $data->month);
                                                    echo $monthName = $dateObj->format('F');
                                                @endphp
                                            </th>
                                        @endforeach
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Downpayment</td>
                                        @foreach ($sales as $data)
                                            <td>{{ $data->downpayment }}
                                                @php
                                                    $down_sum[] = $data->downpayment;
                                                @endphp
                                            </td>
                                        @endforeach
                                        <td>
                                            {{ array_sum($down_sum) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fully Paid</td>
                                        @foreach ($sales as $data)
                                            <td>{{ $data->total_sales }}
                                                @php
                                                    $sales_sum[] = $data->total_sales;
                                                @endphp
                                            </td>
                                        @endforeach
                                        <td>
                                            {{ array_sum($sales_sum) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <thead>
                                        <tr>
                                            <th>Count</th>
                                            <th>
                                                @php
                                                    echo $quotient = round(array_sum($sales_sum) / 6000, 2);
                                                @endphp
                                            </th>
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
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Count</th>
                                        <th>Compensation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cancelled as $data)
                                        <tr>
                                            <td>
                                                @php
                                                    $dateObj = DateTime::createFromFormat('!m', $data->month);
                                                    echo $monthName = $dateObj->format('F');
                                                @endphp
                                            </td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-footer">
                        <a href="{{ url('yearly_earning_report_print', ['year' => $year]) }}" target="_blank"
                            class="btn float-right btn-info">Print</a>
                    </div>
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
