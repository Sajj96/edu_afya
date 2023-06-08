@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user') }}">Users </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.create')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>User Details</h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-12">
                                    <div class="form-group local-forms">
                                        <label>Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" placeholder="" required value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Phone Number <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="phone" placeholder="" value="{{ old('phone') }}" require>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Email <span class="login-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" placeholder="" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Password <span class="login-danger">*</span></label>
                                        <input class="form-control" type="password" name="password" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Confirm Password <span class="login-danger">*</span></label>
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Location <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="location" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>City <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="city">
                                            <option value="">{{ __('Please select')}}</option>
                                            <option value="Arusha">Arusha</option>
                                            <option value="Dar es Salaam">Dar es Salaam</option>
                                            <option value="Dodoma">Dodoma</option>
                                            <option value="Geita">Geita</option>
                                            <option value="Iringa">Iringa</option>
                                            <option value="Kagera">Kagera</option>
                                            <option value="Katavi">Katavi</option>
                                            <option value="Kigoma">Kigoma</option>
                                            <option value="Kilimanjaro">Kilimanjaro</option>
                                            <option value="Lindi">Lindi</option>
                                            <option value="Manyara">Manyara</option>
                                            <option value="Mara">Mara</option>
                                            <option value="Mbeya">Mbeya</option>
                                            <option value="Morogoro">Morogoro</option>
                                            <option value="Mtwara">Mtwara</option>
                                            <option value="Mwanza">Mwanza</option>
                                            <option value="Njombe">Njombe</option>
                                            <option value="Pemba North">Pemba North</option>
                                            <option value="Pemba South">Pemba South</option>
                                            <option value="Pwani">Pwani</option>
                                            <option value="Rukwa">Rukwa</option>
                                            <option value="Ruvuma">Ruvuma</option>
                                            <option value="Shinyanga">Shinyanga</option>
                                            <option value="Simiyu">Simiyu</option>
                                            <option value="Singida">Singida</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Roles <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="roles[]">
                                            <option value="">{{ __('Please select')}}</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="doctor-submit text-end">
                                        <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
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
@endsection