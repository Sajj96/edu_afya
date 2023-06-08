@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
            @include('flash-message')
                <div class="card-box">
                    <div class="card-block">
                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Roles List</h3>
                                        <div class="doctor-search-blk">
                                            <div class="add-group">
                                                <a href="{{ route('role.create') }}" class="btn btn-primary add-pluss ms-2"><img src="{{ asset('assets/img/icons/plus.svg')}}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="datatable table border-0 custom-table comman-table table-stripped ">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $key=>$role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td class="center">
                                            <a href="{{ route('role.edit', $role->id) }}" class="check-point status-green me-1"><i class="feather-edit"></i> Edit</a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#delete_patient{{$role->id}}" class="check-point status-pink "><i class="feather-trash"></i> Delete</a>
                                            <div id="delete_patient{{$role->id}}" class="modal fade delete-modal" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                                                            <h3>Are you sure want to delete this ?</h3>
                                                            <form id="delete-form-{{ $role->id }}" action="{{ route('role.delete') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>
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
    </div>
    @endsection