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
                        <li class="breadcrumb-item active">Doctors</li>
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
                                        <h3>Doctors List</h3>
                                        <div class="doctor-search-blk">
                                            <div class="add-group">
                                                <a href="{{ route('doctor.create') }}" class="btn btn-primary add-pluss ms-2"><img src="{{ asset('assets/img/icons/plus.svg')}}" alt=""></a>
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
                                        <th>Category</th>
                                        <th>Profession</th>
                                        <th>Hospital</th>
                                        <th>Email</th>
                                        <th>Consultation Fee</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($doctors as $key=>$doctor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('doctor.details', $doctor->id) }}">{{ $doctor->name }}</a></td>
                                        <td>{{ $doctor->category }}</td>
                                        <td>{{ $doctor->profession }}</td>
                                        <td>{{ $doctor->hospital }}</td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>{{ number_format(intval($doctor->consultation_fee)) }}</td>
                                        <td>
                                            @if($doctor->status == 0)
                                            <span class="custom-badge status-red">Inactive</span>
                                            @else
                                            <span class="custom-badge status-green">Active</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('doctor.details', $doctor->id)}}"><i class="fa-solid fa-eye m-r-5"></i> View</a>
                                                    <a class="dropdown-item" href="{{ route('doctor.edit', $doctor->id)}}"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_patient-{{ $doctor->id }}"><i class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                </div>
                                                <div id="delete_patient-{{ $doctor->id }}" class="modal fade delete-modal" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('assets/img/sent.png')}}" alt="" width="50" height="46">
                                                                <h3>Are you sure want to delete this ?</h3>
                                                                <form id="delete-form-{{ $doctor->id }}" action="{{ route('doctor.delete') }}" method="POST">
                                                                    @csrf 
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                                                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
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