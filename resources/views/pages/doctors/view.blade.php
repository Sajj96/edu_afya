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
                                            <div class="follow-group">
                                                <div class="doctor-follows">
                                                    <h5>Videos</h5>
                                                    <h4>250</h4>
                                                </div>
                                            </div>
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
                                    <div class="about-me-list">
                                        <ul class="list-space">
                                            <li>
                                                <h4>Gender</h4>
                                                <span>Female</span>
                                            </li>
                                            <li>
                                                <h4>Operation Done</h4>
                                                <span>30+</span>
                                            </li>
                                            <li>
                                                <h4>Designation</h4>
                                                <span>Sr. Doctor</span>
                                            </li>
                                        </ul>
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
                                            <li>
                                                <a href="#"><span class="set-about-icon me-2"><img src="{{ asset('assets/img/icons/menu-icon-16.svg')}}" alt=""></span>Settings</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="personal-list-out">
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="detail-personal">
                                                    <h2>Full Name</h2>
                                                    <h3>{{ ucwords($doctor->name) }}</h3>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="detail-personal">
                                                    <h2>Mobile </h2>
                                                    <h3>264-625-2583</h3>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="detail-personal">
                                                    <h2>Email</h2>
                                                    <h3><a href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a></h3>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="detail-personal">
                                                    <h2>Location</h2>
                                                    <h3>Los Angeles</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hello-park">
                                        <p>Completed my graduation in Gynaecologist Medicine from the well known and renowned
                                            institution of India – SARDAR PATEL MEDICAL COLLEGE, BARODA in 2000-01, which was affiliated
                                            to M.S. University. I ranker in University exams from the same university from 1996-01.</p>
                                        <p>Worked as Professor and Head of the department ; Community medicine Department at Sterline
                                            Hospital, Rajkot, Gujarat from 2003-2015</p>
                                    </div>
                                    <div class="hello-park mb-2">
                                        <h5>Education</h5>
                                        <div class="table-responsive">
                                            <table class="table mb-0 border-0 custom-table profile-table">
                                                <thead>
                                                    <th>Year</th>
                                                    <th>Degree</th>
                                                    <th>Institute</th>
                                                    <th>Result</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>2002-2005</td>
                                                        <td>M.D. of Medicine</td>
                                                        <td>University of Wyoming </td>
                                                        <td>
                                                            <button class="custom-badge status-green ">Distinction</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2005-2014</td>
                                                        <td>MBBS</td>
                                                        <td>Netherland Medical College </td>
                                                        <td>
                                                            <button class="custom-badge status-green ">Distinction</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="hello-park mb-2">
                                        <h5>Experience</h5>
                                        <div class="table-responsive">
                                            <table class="table mb-0 border-0 custom-table profile-table">
                                                <thead>
                                                    <th>Year</th>
                                                    <th>Position</th>
                                                    <th>Hospital</th>
                                                    <th>Feedback</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>2002-2005</td>
                                                        <td>Senior doctor </td>
                                                        <td>Midtown Medical Clinic </td>
                                                        <td>
                                                            <button class="custom-badge status-orange ">Good</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2005-2014</td>
                                                        <td>Associate Prof. </td>
                                                        <td>Netherland Medical College </td>
                                                        <td>
                                                            <button class="custom-badge status-green ">Excellence</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="hello-park">
                                        <h5>Conferences, Cources & Workshop Attended</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                            labore et dolore magna aliqua.</p>
                                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                                            anim id est laborum.</p>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                            laudantium, totam rem aperiam</p>
                                        <p class="mb-0">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                                            laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit
                                            qui in ea voluptate velit esse quam nihil molestiae consequatur</p>
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