@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Admin Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">
                        <h2>Good Morning, <span>{{ Auth::user()->name }}</span></h2>
                        <p>Have a nice day at work</p>
                    </div>
                </div>
                <div class="col-md-6 position-blk">
                    <div class="morning-img">
                        <img src="{{ asset('assets/img/morning-img-01.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="doctor-list-blk">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="doctor-widget border-right-bg">
                        <div class="doctor-box-icon flex-shrink-0">
                            <img src="assets/img/icons/doctor-dash-02.svg" alt="">
                        </div>
                        <div class="doctor-content dash-count flex-grow-1">
                            <h4><span class="counter-up">{{ $doctors }}</span><span></span></h4>
                            <h5>Doctors</h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="doctor-widget border-right-bg">
                        <div class="doctor-box-icon flex-shrink-0">
                            <i class="feather-users feather-32 text-white"></i>
                        </div>
                        <div class="doctor-content dash-count flex-grow-1">
                            <h4><span class="counter-up">{{ $users }}</span><span></span></h4>
                            <h5>Users</h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="doctor-widget border-right-bg">
                        <div class="doctor-box-icon flex-shrink-0">
                            <i class="feather-video feather-32 text-white"></i>
                        </div>
                        <div class="doctor-content dash-count flex-grow-1">
                            <h4><span class="counter-up">{{ $videos }}</span><span></span></h4>
                            <h5>Videos</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection