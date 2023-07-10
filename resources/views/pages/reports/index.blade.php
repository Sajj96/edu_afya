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
                        <li class="breadcrumb-item active">Reports</li>
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
                                        <h3>Reports</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="staff-search-table">
                            <form>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Patient </label>
                                            <select class="form-control select">
                                                <option>Select Patient</option>
                                                <option>Bernardo James</option>
                                                <option>Galaviz Lalema</option>
                                                <option>Tarah Williams </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms cal-icon">
                                            <label>From </label>
                                            <input class="form-control datetimepicker" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms cal-icon">
                                            <label>To </label>
                                            <input class="form-control datetimepicker" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="doctor-submit">
                                            <button type="submit" class="btn btn-primary submit-list-form me-2">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection