@extends('layouts.app')

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick-theme.css')}}">
@endsection

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
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Banners</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @include('flash-message')
                <div class="card-box">
                    <div class="card-block">
                        <div class="banner slider">
                            @foreach($banners as $rows)
                            <div class="profile-bg-img">
                                <img src="{{ $rows->image_url }}" alt="{{ $rows->title }}" height="400">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-block">
                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Banners List</h3>
                                        <div class="doctor-search-blk">
                                            <div class="add-group">
                                                <a href="{{ route('banner.create') }}" class="btn btn-primary add-pluss ms-2"><img src="{{ asset('assets/img/icons/plus.svg')}}" alt=""></a>
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
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image Url</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $key=>$banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->description }}</td>
                                        <td><a href="{{ $banner->image_url }}">{{ substr($banner->image_url, strrpos($banner->image_url, '/') + 1) }}</a></td>
                                        <td class="text-end">
                                            <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_patient-{{ $banner->id }}"><i class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                            <div id="delete_patient-{{ $banner->id }}" class="modal fade delete-modal" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('assets/img/sent.png')}}" alt="" width="50" height="46">
                                                            <h3>Are you sure want to delete this ?</h3>
                                                            <form id="delete-form-{{ $banner->id }}" action="{{ route('banner.delete') }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="banner_id" value="{{ $banner->id }}">
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
    @section('page-scripts')
    <script src="{{ asset('assets/plugins/slick/slick.js')}}"></script>
    <script>
        if ($(".banner").length > 0) {
        $(".banner").slick({
            centerMode: true,
            dots: true,
            infinite: true,
            autoplay: true,
            arrows: true,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    }
    </script>
    @endsection
    @endsection