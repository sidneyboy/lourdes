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
                <div class="card-header">About</div>
                <div class="card-body">
                    <form action="{{ route('about_process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Descriptions</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" required name="images">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success float-right" type="submit">Submit</button>
                        </div>
                    </form>
                    {{-- @if ($about_count == 0)
                    @else
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>About</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($about as $data)
                                    <tr>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#exampleModalabout{{ $data->id }}">
                                                {{ $data->about }}
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalabout{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">About</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('about_edit_process') }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <textarea name="about_edit" class="form-control" required cols="30" rows="10">{{ $data->about }}</textarea>
                                                                <input type="hidden" value="{{ $data->id }}"
                                                                    name="about_id">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#exampleModalimage{{ $data->idF }}">
                                                <img src="{{ asset('/storage/' . $data->image) }}"
                                                    class="img img-thumbnail">
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalimage{{ $data->idF }}"
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
                                                        <form action="{{ route('about_edit_image') }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="file" class="form-control" required
                                                                    name="images">
                                                                <input type="hidden" value="{{ $data->id }}"
                                                                    name="about_id">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif --}}
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>About</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($about as $data)
                                <tr>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#exampleModalabout{{ $data->id }}">
                                            {{ $data->about }}
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalabout{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">About</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('about_edit_process') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea name="about_edit" class="form-control" required cols="30" rows="10">{{ $data->about }}</textarea>
                                                            <input type="hidden" value="{{ $data->id }}"
                                                                name="about_id">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#exampleModalimage{{ $data->idF }}">
                                            <img src="{{ asset('/storage/' . $data->image) }}" class="img img-thumbnail">
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalimage{{ $data->idF }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('about_edit_image') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="file" class="form-control" required
                                                                name="images">
                                                            <input type="hidden" value="{{ $data->id }}"
                                                                name="about_id">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
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
@endsection
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

