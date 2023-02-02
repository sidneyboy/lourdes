<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Receipt</title>
</head>

<body>
    <br />

    <center>
        <h3>Nikan Magdale</h3>
        <h4>Exclusive</h4>
        <h5>Official Receipt</h5>
        <br />
        <table class="table table-bordered table-sm" style="text-align: center;width:50%;">
            <thead>
                <tr>
                    <th style="text-align: right">Complate Name:</th>
                    <th style="text-align: left">{{ Str::ucfirst($data->first_name) }}
                        {{ Str::ucfirst($data->last_name) }}</th>
                </tr>
                <tr>
                    <th style="text-align: right">Date Transacted:</th>
                    <th style="text-align: left">{{ date('F j, Y', strtotime($data->created_at)) }}</th>
                </tr>
                <tr>
                    <th style="text-align: right">Date of Reservation:</th>
                    <th style="text-align: left">{{ date('F j, Y', strtotime($data->date_from)) }}</th>
                </tr>
                <tr>
                    <th style="text-align: right">Date Downpayment:</th>
                    <th style="text-align: left">
                        @foreach ($data->reservation_details as $details)
                            @if ($details->status == 'Paid Downpayment')
                                {{ date('F j, Y', strtotime($details->created_at)) }}
                            @endif
                        @endforeach
                    </th>
                </tr>
                @foreach ($data->reservation_details as $details)
                    @if ($details->status == 'Partial Payment')
                        <tr>
                            <th style="text-align: right">Date Partial Payment:</th>
                            <th style="text-align: left">
                                {{ date('F j, Y', strtotime($details->created_at)) }}
                            </th>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th style="text-align: right">Date Full Payment:</th>
                    <th style="text-align: left">
                        @foreach ($data->reservation_details as $details)
                            @if ($details->status == 'Paid')
                                {{ date('F j, Y', strtotime($details->created_at)) }}
                            @endif
                        @endforeach
                    </th>
                </tr>
                <tr>
                    <th style="text-align: right">Total Amount Paid:</th>
                    <th style="text-align: left">
                        @foreach ($data->reservation_details as $details)
                            @php
                                $sum[] = $details->downpayment + $details->payment;
                            @endphp
                        @endforeach
                        @php
                            echo array_sum($sum);
                        @endphp
                    </th>
                </tr>
            </thead>
        </table>

        <h5>
            “THANK YOU FOR CHOOSING NIKAN RESORT
            EXCLUSIVE. WE ENJOY YOUR STAY. BALIK-BALIK”
        </h5>
    </center>

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
