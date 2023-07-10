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
                        <li class="breadcrumb-item"><a href="{{ route('chat') }}">Chat </a></li>
                    </ul>
                </div>
            </div>
        </div>
        @include('flash-message')
        <div class="row">
            <div class="col-xl-4 d-flex">
                <div class="card chat-box">
                    <div class="chat-widgets">
                        <form method="GET" action="{{ route('chat') }}">
                            <div class="call-all comman-space-flex">
                                <h4>Search Conversation</h4>
                            </div>
                            <div class="form-group local-forms">
                                <label>Doctors <span class="login-danger">*</span></label>
                                <select class="form-control select" name="doctor">
                                    <option value="">Please Select</option>
                                    @foreach($doctors_list as $key=>$doctor)
                                    <option {{ request()->get('doctor') == $doctor['id'] ? 'selected' : '' }} value="{{ $doctor['id'] }}">
                                        <h5>{{ $doctor['name'] }}</h5>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group local-forms">
                                <label>Clients <span class="login-danger">*</span></label>
                                <select class="form-control select" name="client">
                                    <option value="">Please Select</option>
                                    @foreach($clients_list as $key=>$client)
                                    <option {{ request()->get('client') == $client['id'] ? 'selected' : '' }} value="{{ $client['id'] }}">
                                        <h5>{{ $client['name'] }}</h5>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary submit-list-form me-2">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                @if(request()->has('doctor') && request()->has('client'))
                <div class="card chat-box ">
                    <div class=" chat-search-group ">
                        <div class="chat-user-group mb-0 d-flex align-items-center">
                            <div class="img-users call-user">
                                <a href="profile.html"><img src="{{ asset('assets/img/user.jpg')}}" alt="img"></a>
                                <span class="active-users bg-info"></span>
                            </div>
                            <div class="chat-users">
                                <div class="user-titles">
                                    <h5> {{ $participants->doctorName }}</h5>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-center text-primary">VS</h3>
                        <div class="chat-user-group mb-0 d-flex align-items-center">
                            <div class="img-users call-user">
                                <a href="profile.html"><img src="{{ asset('assets/img/user.jpg')}}" alt="img"></a>
                                <span class="active-users bg-info"></span>
                            </div>
                            <div class="chat-users">
                                <div class="user-titles">
                                    <h5> {{ $participants->clientName }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card chat-message-box">
                    <div class="card-body p-0">
                        <div class="chat-body" id="msg_list">
                            @forelse($conversations as $key=>$msg)
                            <ul class="list-unstyled chat-message">
                                @if($msg['receiverID'] == $msg['client'])
                                <li class="media d-flex received">
                                    <div class="media-body flex-grow-1">
                                        <div class="msg-box">
                                            <div class="message-sub-box">
                                                <h4>{{ $msg['doctorName']}}</h4>
                                                <p>{{ $msg['message']}}</p>
                                                <span>{{ $msg['timestamp']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                                @if($msg['receiverID'] == $msg['doctor'])
                                <li class="media d-flex sent">
                                    <div class="media-body flex-grow-1">
                                        <div class="msg-box">
                                            <div class="message-sub-box">
                                                <h4>{{ $msg['clientName']}}</h4>
                                                <p>{{ $msg['message']}}</p>
                                                <span>{{ $msg['timestamp']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            @empty
                            <div>
                                <img src="{{ asset('assets/img/no_message.png')}}" class="img-fluid call-imgs" alt="">
                            </div>
                            @endforelse
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