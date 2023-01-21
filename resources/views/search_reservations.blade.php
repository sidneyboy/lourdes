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
                    <form action="{{ route('search_reservations') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="daterange" class="form-control" />
                                <br />
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="search_for" value="paid_downpayment">
                                <button type="submit" class="btn float-left btn-success">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <td>Date Transacted</td>
                                    <td>Reservation Date</td>
                                    <td>Status</td>
                                    <td>First Name</td>
                                    <td>Middle Name</td>
                                    <td>Last Name</td>
                                    <td>Information</td>
                                    <td>Payment</td>
                                    <td>Cancel Option</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $data)
                                    <tr>
                                        <td>{{ date('F j, Y', strtotime($data->created_at)) }}
                                        </td>
                                        <td>{{ date('F j, Y', strtotime($data->date_from)) }}
                                        </td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->first_name }}</td>
                                        <td>{{ $data->middle_name }}</td>
                                        <td>{{ $data->last_name }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-primary btn-block"
                                                data-toggle="modal"
                                                data-target="#exampleModalview_details{{ $data->id }}">
                                                View Details
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalview_details{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Reservation
                                                                Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-sm table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Email</th>
                                                                        <th>Contact Number</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $data->email }}</td>
                                                                        <td>{{ $data->number }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                            <br />

                                                            <img src="{{ asset('/storage/' . $data->receipt) }}"
                                                                class="img img-thumbnail">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ url('paid_downpayment_proecss', [
                                                'id' => $data->id,
                                                'email' => $data->email,
                                            ]) }}"
                                                class="btn btn-success btn-block btn-sm"
                                                style="margin-bottom: 10px;">Confirm</a>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-info btn-block" data-toggle="modal"
                                                data-target="#exampleModal">
                                                Amount
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
                                                        <form action="{{ url('reservation_process_data') }}"
                                                            method="post">
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
                                            @if ($data->status == 'Pending')
                                                <button type="button" class="btn btn-sm btn-block btn-danger"
                                                    data-toggle="modal"
                                                    data-target="#exampleModalcancelled{{ $data->id }}">
                                                    Cancel
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalcancelled{{ $data->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('cancel_reservation') }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <label for="">Reason</label>
                                                                    <textarea name="cancel_description" class="form-control" cols="30" rows="10"></textarea>

                                                                    <input type="hidden" name="id"
                                                                        value="{{ $data->id }}">
                                                                    <input type="hidden" name="email"
                                                                        value="{{ $data->email }}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btns-sm btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btns-sm btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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