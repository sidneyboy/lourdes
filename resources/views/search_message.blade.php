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
                <div class="card-header">Customer Message</div>
                <div class="card-body">
                    <form action="{{ route('search_message') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="daterange" class="form-control"/>
                                <br />
                            </div>
                            <div class="col-md-4">
                                {{-- <input type="hidden" name="search_for" value="paid_downpayment"> --}}
                                <button type="submit" class="btn float-left btn-success">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th>Message</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact_us as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->number }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-primary btn-block"
                                                data-toggle="modal" data-target="#exampleModalreply{{ $data->id }}">
                                                Open
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalreply{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Customer Message
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('message_process') }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        {{ $data->message }}
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <textarea name="message" class="form-control" cols="30" rows="5"></textarea>
                                                                        <input type="hidden" value="{{ $data->email }}"
                                                                            name="email">
                                                                        <input type="hidden" value="{{ $data->id }}"
                                                                            name="id">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="subit"
                                                                    class="btn btn-sm btn-primary">Reply</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-info btn-block" data-toggle="modal"
                                                data-target="#exampleModaldetails{{ $data->id }}">
                                                View
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModaldetails{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Message Details
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered table-hover table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Received</th>
                                                                        <th>Replied</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @if ($data->status == 'Pending')
                                                                            <td>{{ date('F j, Y', strtotime($data->created_at)) }}
                                                                            </td>
                                                                            <td></td>
                                                                            <td>{{ $data->status }}</td>
                                                                        @else
                                                                            <td>{{ date('F j, Y', strtotime($data->created_at)) }}
                                                                            </td>
                                                                            <td>{{ date('F j, Y', strtotime($data->updated_at)) }}
                                                                            </td>
                                                                            <td>{{ Str::ucfirst($data->status) }}</td>
                                                                        @endif
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
