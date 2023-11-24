@php
$hours = '';
$time = date('H');
if ($time < "12" ) { $hours='Good morning' ; } else if ($time>= "12" && $time < "15" ) { $hours='Good afternoon' ; } else if ($time>= "15" && $time < "19" ) { $hours='Good evening' ; } else if ($time>= "19") {
$hours = 'Good night';
}
@endphp
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
                        <h2>{{ $hours }}, <span>{{ Auth::user()->name }}</span></h2>
                        <p>Hope you have a great work</p>
                    </div>
                </div>
                <div class="col-md-6 position-blk"></div>
            </div>
        </div>
        <div class="doctor-list-blk">
            <div class="row">
                @can(\App\Models\PermissionSet::PERMISSION_DOCTORS_VIEW)
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
                @endcan
                @can(\App\Models\PermissionSet::PERMISSION_USERS_VIEW)
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
                @endcan
                @can(\App\Models\PermissionSet::PERMISSION_VIDEOS_VIEW)
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
                @endcan
            </div>
        </div>
        <div class="row">
            @can(\App\Models\PermissionSet::PERMISSION_TRANSACTIONS_VIEW)
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                <div class="dash-widget">
                    <div class="dash-boxs comman-flex-center">
                        <img src="{{ asset('assets/img/icons/menu-icon-09.svg') }}" alt="">
                    </div>
                    <div class="dash-content dash-count">
                        <h4>New Subscriptions</h4>
                        <h2><span class="counter-up">{{ array_sum($subscription_data) }}</span></h2>
                        <p><span class="passive-view">This week</p>
                    </div>
                </div>
            </div>
            @endcan
            @can(\App\Models\PermissionSet::PERMISSION_USERS_VIEW)
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                <div class="dash-widget">
                    <div class="dash-boxs comman-flex-center">
                        <img src="{{ asset('assets/img/icons/profile-add.svg')}}" alt="">
                    </div>
                    <div class="dash-content dash-count">
                        <h4>New Users</h4>
                        <h2><span class="counter-up">{{ count($new_users)}}</span></h2>
                        <p><span class="passive-view">This week</p>
                    </div>
                </div>
            </div>
            @endcan
            @can(\App\Models\PermissionSet::PERMISSION_TRANSACTIONS_VIEW)
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                <div class="dash-widget">
                    <div class="dash-boxs comman-flex-center">
                        <img src="{{ asset('assets/img/icons/empty-wallet.svg')}}" alt="">
                    </div>
                    <div class="dash-content dash-count">
                        <h4>Earnings</h4>
                        <h2>Tshs <span class="counter-up"> {{ number_format($earnings) }}</span></h2>
                        <p><span class="passive-view">Overall</p>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        <div class="row">
            @can(\App\Models\PermissionSet::PERMISSION_DOCTORS_VIEW)
            <div class="col-12 col-md-12 col-lg-6 col-xl-4 d-flex">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Doctors by Department</h4>
                        </div>
                        <div id="doctors-chart-dash" class="chart-user-icon">
                            <img src="{{ asset('assets/img/icons/user-icon.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>
@section('page-scripts')
<script>
    var subscriptions = <?php echo json_encode($subscription_data); ?>;
    var category = <?php echo json_encode($category); ?>;
    var occurrence = <?php echo json_encode($category_occurrence); ?>;

    if ($("#payment-chart").length > 0) {
        var sColStacked = {
            chart: {
                height: 230,
                type: "bar",
                stacked: false,
                toolbar: {
                    show: false
                },
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: "bottom",
                        offsetX: -10,
                        offsetY: 0,
                    },
                },
            }, ],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%"
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 6,
                colors: ["transparent"]
            },
            series: [{
                    name: "Subscription",
                    color: "#bf1e2e",
                    data: subscriptions,
                },
            ],
            xaxis: {
                categories: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thur",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#payment-chart"),
            sColStacked
        );
        chart.render();
    }

    if ($("#doctors-chart-dash").length > 0) {
        var donutChart = {
            chart: {
                height: 290,
                type: "donut",
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "50%"
                }
            },
            dataLabels: {
                enabled: false
            },
            series: occurrence,
            labels: category,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: "bottom"
                    },
                },
            }, ],
            legend: {
                position: "bottom"
            },
        };
        var donut = new ApexCharts(
            document.querySelector("#doctors-chart-dash"),
            donutChart
        );
        donut.render();
    }
</script>
@endsection
@endsection