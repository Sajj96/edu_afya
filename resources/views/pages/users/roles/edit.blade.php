@extends('layouts.app')


@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('role') }}">Roles </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Edit Role</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('role.create')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Role Details</h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-12">
                                    <div class="form-group local-forms">
                                        <label>Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" placeholder="" required value="{{ $role->name }}">
                                        <input type="hidden" name="id" value="{{ $role->id }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-12">
                                    <div class="form-group local-forms">
                                        <label>Permissions <span class="login-danger">*</span></label>
                                        @foreach($permissions as $permission)
                                        <div class="table-responsive">
                                            <table class="table custom-table comman-table mb-0" id="permissions-list">
                                                <thead>
                                                    <tr>
                                                        <th class="table-secondary">{{ $permission['name'] }} Permissions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($permission['permissions'] as $perm)
                                                    <tr>
                                                        <td class="d-flex">
                                                            <div class="top-check mr-2">
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="permissions[]" @if(in_array($perm, $rolePermissions)) checked="checked" @endif value="{{ $perm  }}"  class="form-check-input">
                                                                </div>
                                                            </div>
                                                            {{ str_replace('_',' ',str_replace('PERMISSION_','',$perm)) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endforeach
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