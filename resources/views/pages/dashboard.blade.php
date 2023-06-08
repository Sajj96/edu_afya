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
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget">
                    <div class="dash-boxs comman-flex-center">
                        <img src="assets/img/icons/profile-add.svg" alt="">
                    </div>
                    <div class="dash-content dash-count">
                        <h4>Doctors</h4>
                        <h2><span class="counter-up">{{ $doctors }}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget">
                    <div class="dash-boxs comman-flex-center">
                        <img src="assets/img/icons/menu-icon-03.svg" alt="">
                    </div>
                    <div class="dash-content dash-count">
                        <h4>Users</h4>
                        <h2><span class="counter-up">{{ $users }}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget">
                    <div class="dash-boxs comman-flex-center">
                        <i class="feather-video"></i>
                    </div>
                    <div class="dash-content dash-count">
                        <h4>Videos</h4>
                        <h2><span class="counter-up">{{ $videos }}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection