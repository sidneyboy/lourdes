<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Print</title>
</head>

<body>
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
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script>
          window.print();
    </script>
</body>

</html>
