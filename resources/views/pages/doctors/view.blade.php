@extends('layouts.app')

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs5.min.css')}}">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('doctor') }}">Doctors </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Doctors Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about-info">
                                    <h4>Doctor Profile <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span>
                                    </h4>
                                </div>
                                <div class="doctor-profile-head">
                                    <div class="profile-bg-img">
                                        <img src="{{ asset('assets/img/profile-banner.png')}}" alt="Profile">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="profile-user-box">
                                                <div class="profile-user-img">
                                                    <img src="{{ $doctor->image_url }}" alt="Profile">
                                                    <div class="form-group doctor-up-files profile-edit-icon mb-0">
                                                        <div class="uplod d-flex">
                                                            <label class="file-upload profile-upbtn mb-0">
                                                                <img src="{{ asset('assets/img/icons/camera-icon.svg')}}" alt="Profile"></i><input type="file">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="names-profiles">
                                                    <h4>{{ ucwords($doctor->name) }}</h4>
                                                    <h5>{{ ucfirst($doctor->profession) }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                        </div>
                                        <div class="col-lg-2 col-md-2 d-flex align-items-center">
                                        </div>
                                        <div class="col-lg-2 col-md-2 d-flex align-items-center">
                                            <div class="follow-btn-group">
                                                <button type="submit" class="btn btn-info message-btns">Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="doctor-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="heading-detail ">
                                        <h4 class="mb-3">Bio</h4>
                                        <p>{{ $doctor->bio }}.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="doctor-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content-set">
                                        <ul class="nav">
                                            <li>
                                                <a href="#" class="active"><span class="set-about-icon me-2"><img src="{{ asset('assets/img/icons/menu-icon-02.svg')}}" alt=""></span>About me</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="personal-list-out">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6">
                                                <div class="detail-personal">
                                                    <h2>Full Name</h2>
                                                    <h3>{{ ucwords($doctor->name) }}</h3>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6">
                                                <div class="detail-personal">
                                                    <h2>Email</h2>
                                                    <h3><a href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a></h3>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6">
                                                <div class="detail-personal">
                                                    <h2>Hospital</h2>
                                                    <h3>{{ ucwords($doctor->hospital) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page-scripts')
<script src="{{ asset('assets/plugins/summernote/summernote-bs5.min.js')}}"></script>
@endsection
@endsection