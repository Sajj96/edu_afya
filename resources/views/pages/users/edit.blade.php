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
                        <li class="breadcrumb-item active">Edit User</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.edit', $user->id)}}" method="post">
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
                                        <input class="form-control" type="text" name="name" placeholder="" required value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Phone Number <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="phone" placeholder="" value="{{ $user->phonenumber }}" require>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Email <span class="login-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" placeholder="" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>New Password <span class="login-danger">*</span></label>
                                        <input class="form-control" type="password" name="password" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Confirm Password <span class="login-danger">*</span></label>
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Location <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="location" value="{{ $user->location }}" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>City <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="city">
                                            <option value="">{{ __('Please select')}}</option>
                                            <option {{ $user->city == "Arusha" ? 'selected' : '' }} value="Arusha">Arusha</option>
                                            <option {{ $user->city == "Dar es Salaam" ? 'selected' : '' }} value="Dar es Salaam">Dar es Salaam</option>
                                            <option {{ $user->city == "Dodoma" ? 'selected' : '' }} value="Dodoma">Dodoma</option>
                                            <option {{ $user->city == "Geita" ? 'selected' : '' }} value="Geita">Geita</option>
                                            <option {{ $user->city == "Iringa" ? 'selected' : '' }} value="Iringa">Iringa</option>
                                            <option {{ $user->city == "Kagera" ? 'selected' : '' }} value="Kagera">Kagera</option>
                                            <option {{ $user->city == "Katavi" ? 'selected' : '' }} value="Katavi">Katavi</option>
                                            <option {{ $user->city == "Kigoma" ? 'selected' : '' }} value="Kigoma">Kigoma</option>
                                            <option {{ $user->city == "Kilimanjaro" ? 'selected' : '' }} value="Kilimanjaro">Kilimanjaro</option>
                                            <option {{ $user->city == "Lindi" ? 'selected' : '' }} value="Lindi">Lindi</option>
                                            <option {{ $user->city == "Manyara" ? 'selected' : '' }} value="Manyara">Manyara</option>
                                            <option {{ $user->city == "Mara" ? 'selected' : '' }} value="Mara">Mara</option>
                                            <option {{ $user->city == "Mbeya" ? 'selected' : '' }} value="Mbeya">Mbeya</option>
                                            <option {{ $user->city == "Morogoro" ? 'selected' : '' }} value="Morogoro">Morogoro</option>
                                            <option {{ $user->city == "Mtwara" ? 'selected' : '' }} value="Mtwara">Mtwara</option>
                                            <option {{ $user->city == "Mwanza" ? 'selected' : '' }} value="Mwanza">Mwanza</option>
                                            <option {{ $user->city == "Njombe" ? 'selected' : '' }} value="Njombe">Njombe</option>
                                            <option {{ $user->city == "Pemba North" ? 'selected' : '' }} value="Pemba North">Pemba North</option>
                                            <option {{ $user->city == "Pemba South" ? 'selected' : '' }} value="Pemba South">Pemba South</option>
                                            <option {{ $user->city == "Pwani" ? 'selected' : '' }} value="Pwani">Pwani</option>
                                            <option {{ $user->city == "Rukwa" ? 'selected' : '' }} value="Rukwa">Rukwa</option>
                                            <option {{ $user->city == "Ruvuma" ? 'selected' : '' }} value="Ruvuma">Ruvuma</option>
                                            <option {{ $user->city == "Shinyanga" ? 'selected' : '' }} value="Shinyanga">Shinyanga</option>
                                            <option {{ $user->city == "Simiyu" ? 'selected' : '' }} value="Simiyu">Simiyu</option>
                                            <option {{ $user->city == "Simiyu" ? 'selected' : '' }} value="Simiyu">Singida</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Roles <span class="login-danger">*</span></label>
                                        <select class="form-control select">
                                            <option value="">{{ __('Please select')}}</option>
                                            @foreach($roles as $role)
                                            <option {{ in_array($role->name,[$user->getRoleNames()]) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
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