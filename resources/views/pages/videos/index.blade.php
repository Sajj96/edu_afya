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
                        <li class="breadcrumb-item active">Videos</li>
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
                                        <h3>Videos List</h3>
                                        <div class="doctor-search-blk">
                                            <div class="add-group">
                                                <a href="{{ route('video.create') }}" class="btn btn-primary add-pluss ms-2"><img src="{{ asset('assets/img/icons/plus.svg')}}" alt=""></a>
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videos as $key=>$video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('video.details',$video->id) }}">{{ $video->name }}</a></td>
                                        <td>{{ $video->category }}</td>
                                        <td>
                                            @if($video->status == 0)
                                            <span class="custom-badge status-orange">Pending</span>
                                            @else
                                            <span class="custom-badge status-green">Published</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('video.details', $video->id)}}"><i class="fa-solid fa-eye m-r-5"></i> View</a>
                                                    <a class="dropdown-item" href="{{ route('video.edit', $video->id)}}"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_patient-{{ $video->id }}"><i class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                </div>
                                                <div id="delete_patient-{{ $video->id }}" class="modal fade delete-modal" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('assets/img/sent.png')}}" alt="" width="50" height="46">
                                                                <h3>Are you sure want to delete this ?</h3>
                                                                <form id="delete-form-{{ $video->id }}" action="{{ route('video.delete') }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="video_id" value="{{ $video->id }}">
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