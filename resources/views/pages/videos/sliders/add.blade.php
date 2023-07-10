@extends('layouts.app')

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/tagsinput.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs5.min.css')}}">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="blog.html">Banners </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Add Banner</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.create')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Banner Details</h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Title <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" name="title" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-top-form">
                                        <label class="local-top">Image <span class="login-danger">*</span></label>
                                        <input class="form-control" type="file" accept="image/*" name="image" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Video Id <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" name="video_id" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12">
                                    <div class="form-group summer-mail">
                                        <label>Description</label>
                                        <textarea rows="4" cols="5" class="form-control summernote" name="description" placeholder="Enter your description here"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="doctor-submit text-end">
                                        <button type="submit" class="btn btn-primary submit-form me-2">Publish Banner</button>
                                        <button type="reset" class="btn btn-primary cancel-form">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page-scripts')
<script src="{{ asset('assets/js/tagsinput.js')}}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote-bs5.min.js')}}"></script>
@endsection
@endsection