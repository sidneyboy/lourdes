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
                <div class="card-header">Pending Reservations</div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <td>Status</td>
                                    <td>Payment</td>
                                    <td>Pay Downpayment</td>
                                    <td>First Name</td>
                                    <td>Middle Name</td>
                                    <td>Last Name</td>
                                    <td>Email</td>
                                    <td>Number</td>
                                    <td>Receipt</td>
                                    <td>Reservation Date</td>
                                    <td>Date Transacted</td>
                                    <td>Cancel Option</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $data)
                                    <tr>
                                        <td>
                                            {{ $data->status }}
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">
                                                Payment
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('reservation_process_data') }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Payment</label>
                                                                    <input type="text" name="amount" value=".00"
                                                                        class="form-control" required>

                                                                    <input type="hidden" name="id"
                                                                        value="{{ $data->id }}">
                                                                    <input type="hidden" name="email"
                                                                        value="{{ $data->email }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-sm btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ url('paid_downpayment_proecss', [
                                                'id' => $data->id,
                                                'email' => $data->email,
                                            ]) }}"
                                                class="btn btn-info btn-sm">Pay Downpayment</a>
                                        </td>
                                        <td>{{ $data->first_name }}</td>
                                        <td>{{ $data->middle_name }}</td>
                                        <td>{{ $data->last_name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->number }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal_image{{ $data->id }}">
                                                {{-- <img src="{{ asset('/storage/'. $data->receipt) }}" class="img img-thumbnail"> --}}
                                                Gcash Receipt
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal_image{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset('/storage/' . $data->receipt) }}"
                                                                class="img img-thumbnail">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ date('F j, Y', strtotime($data->date_from)) }}</td>
                                        {{-- <td>{{ $data->date_to }}</td> --}}
                                        <td>{{ date('F j, Y h:i a', strtotime($data->created_at)) }}</td>
                                        <td>
                                            @if ($data->status == 'Pending')
                                                <a href="{{ url('cancel_reservation', [
                                                    'id' => $data->id,
                                                    'email' => $data->email,
                                                ]) }}"
                                                    class="btn btn-danger btn-block">Cancel</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
