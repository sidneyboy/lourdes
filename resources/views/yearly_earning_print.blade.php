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
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Year</th>
                <th>Customer</th>
                <th>Reservation Date</th>
                <th>Status</th>
                <th>Total Payment</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $data)
                <tr>
                    <td>
                        {{ date('Y', strtotime($data->created_at)) }}
                        {{-- @php
                            $dateObj = DateTime::createFromFormat('!m', $data->created_at);
                            echo $monthName = $dateObj->format('F');
                        @endphp --}}
                    </td>

                    <td>{{ $data->first_name . ' ' . $data->middle_name . ' ' . $data->last_name }}</td>
                    <td>{{ date('F j, Y', strtotime($data->date_from)) }}</td>
                    <td>
                        @if ($data->reservation_latest)
                            {{ $data->reservation_latest->status }}
                        @else
                            None
                        @endif
                    </td>
                    <td>₱ {{ number_format($total[$data->id], 2, '.', ',') }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

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
