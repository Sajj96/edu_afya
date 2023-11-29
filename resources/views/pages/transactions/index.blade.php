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
                        <li class="breadcrumb-item active">Doctor Subscriptions</li>
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
                                        <h3>Subscriptions List</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="datatable table border-0 custom-table comman-table table-stripped ">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Doctor Name</th>
                                        <th>Amount</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $key=>$transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="#">{{ $transaction->userName }}</a></td>
                                        <td>{{ $transaction->userPhone }}</td>
                                        <td>{{ $transaction->doctorName }}</td>
                                        <td>{{ number_format($transaction->price) }}</td>
                                        <td>
                                            @if($transaction->payments_status == 0)
                                            <span class="custom-badge status-orange">Pending</span>
                                            @else
                                            <span class="custom-badge status-green">Paid</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($transaction->isActive)
                                            <span class="custom-badge status-green">Active</span>
                                            @else
                                            <span class="custom-badge status-red">Expired</span>
                                            @endif
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