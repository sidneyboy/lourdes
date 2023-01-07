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
                                        <th>{{ round(array_sum($sales_sum) / 6000, 2) }}</th>
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

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>
        -->
</body>

</html>
