@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/magnific-popup/magnific-popup.css')}}">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('video') }}">Videos </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Video Details</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('flash-message')
        <div class="row">
            <div class="col-md-8">
                <div class="blog-view">
                    <article class="blog blog-single-post">
                        <h3 class="blog-title">{{ $video->name }}</h3>
                        <div class="blog-info clearfix">
                            <div class="post-left date-blks">
                                <ul>
                                    <li><a href="#."><i class="feather-calendar"></i> <span>{{ date('d F Y', strtotime($video->created_at)) }}</span></a></li>
                                    <li><a href="#."><i class="feather-message-square"></i> <span>{{ count($comments)}} comments</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="page-content">
                            <div class="meeting">
                                <div class="meeting-wrapper">
                                    <div class="meeting-list">
                                        <div class="join-contents horizontal-view fade-whiteboard">
                                            <div class="join-video user-active">
                                                <img src="{{ $video->image_url }}" class="img-fluid call-imgs" alt="Logo">
                                                <div class="part-name">
                                                    <h4><a class="popup-vimeo text-white" href="https://vimeo.com/{{ $video->video_link_id}}"><i class="feather-play-circle"></i> Play</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content">
                            <p>{{ $video->description }}</p>
                        </div>
                        <div class="blog-share ">
                            <ul class="social-share nav">
                                <li><a href="javascript:;"><img alt="" src="{{ asset('assets/img/icons/social-01.svg') }}"></a></li>
                                <li><a href="javascript:;"><img alt="" src="{{ asset('assets/img/icons/social-02.svg') }}"></a></li>
                                <li><a href="javascript:;"><img alt="" src="{{ asset('assets/img/icons/social-03.svg') }}"></a></li>
                                <li><a href="javascript:;"><img alt="" src="{{ asset('assets/img/icons/social-04.svg') }}"></a></li>
                            </ul>
                        </div>
                        <div class="list-add-blogs">
                            <ul class="nav">
                                @foreach(explode(',',$video->tags) as $key=>$tag)
                                <li># {{ $tag }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                    <div class="widget blog-comments clearfix">
                        <h3>Comments</h3>
                        <ul class="comments-list slimscroll">
                            @foreach($comments as $key=>$comment)
                            <li class="list">
                                <div class="comment">
                                    <div class="comment-author">
                                        <a href="#"><img class="avatar" alt="" src="{{ asset('assets/img/user.jpg')}}"></a>
                                    </div>
                                    <div class="comment-block">
                                        <div class="comment-by">
                                            <div class="week-group">
                                                <h5 class="blog-author-name">{{ $comment->user_name }}</h5>
                                                <span class="week-list">{{ Carbon::createFromFormat('Y-m-d H:i:s', $comment->createddate)->diffForHumans() }}</span>
                                                <a href="#" class="dropdown-toggle " data-bs-toggle="dropdown">
                                                    <span><i class="feather-message-square"></i> {{ count($comment->replies) }} replies</span></a>
                                                <div class="dropdown-menu notifications">
                                                    <div class="topnav-dropdown-header">
                                                        <span>Replies</span>
                                                    </div>
                                                    <div class="drop-scroll">
                                                        <ul class="notification-list">
                                                            @foreach($comment->replies as $reply)
                                                            <li class="notification-message">
                                                                <a href="#">
                                                                    <div class="media">
                                                                        <span class="avatar">
                                                                            <img alt="{{ $reply->user_name }}" src="{{ asset('assets/img/user.jpg')}}" class="img-fluid">
                                                                        </span>
                                                                        <div class="media-body">
                                                                            <p class="noti-details"><span class="noti-title">{{ $reply->user_name }}</span> <span class="week-list">{{ Carbon::createFromFormat('Y-m-d H:i:s', $reply->createddate)->diffForHumans() }}</span></p>
                                                                            <p>{{ $reply->comment }}</p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="float-end">
                                                <span class="blog-reply"><a href="#." data-bs-toggle="modal" data-bs-target="#reply_modal{{ $comment->id }}"><i class="fa fa-reply"></i> Reply</a></span>
                                            </span>
                                            <div id="reply_modal{{ $comment->id }}" class="modal fade delete-modal" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <form action="{{ route('comment.reply') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}" id="">
                                                                <input type="hidden" name="video_id" value="{{ $video->id }}" id="">
                                                                <div class="col-12 col-sm-12">
                                                                    <div class="form-group local-forms">
                                                                        <label>Reply <span class="login-danger">*</span></label>
                                                                        <textarea class="form-control" rows="3" name="comment" cols="30"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                                                                    <button type="submit" class="btn btn-danger">Reply</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <aside class="col-md-4">
                <div class="widget post-widget">
                    <div class="relat-head">
                        <h5>Recent Videos</h5>
                    </div>
                    <ul class="latest-posts">
                        @foreach($recent as $key=>$video)
                        <li>
                            <div class="post-thumb">
                                <a href="{{ route('video.details', $video->id)}}">
                                    <img class="img-fluid" src="{{ $video->image_url }}" alt="">
                                </a>
                            </div>
                            <div class="post-info">
                                <div class="date-posts">
                                    <h5>{{ $video->name }}</h5>
                                    <span class="ms-2">{{ date('d F Y',strtotime($video->created_at)) }}</span>
                                </div>
                                <h4>
                                    <a href="{{ route('video.details', $video->id)}}">{{ str_pad($video->description,0,20) }}...</a>
                                </h4>
                                <a href="{{ route('video.details', $video->id)}}"> View <i class="fa fa-long-arrow-right ms-2"></i></a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
            <div class="col-md-12">
                <div class="widget new-comment clearfix">
                    <h3>Leave a Comment</h3>
                    <form action="{{ route('comment.create') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 col-xl-6">
                                <div class="form-group local-forms">
                                    <label>Name <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-6">
                                <div class="form-group local-forms">
                                    <label>Phone<span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="phone" value="{{ Auth::user()->phonenumber }}" placeholder="Enter phone">
                                    <input class="form-control" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input class="form-control" type="hidden" name="video_id" value="{{ $video->id }}">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group local-forms">
                                    <label>Comments <span class="login-danger">*</span></label>
                                    <textarea class="form-control" rows="3" name="comment" cols="30"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="doctor-submit text-end">
                                    <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page-scripts')
<script src="{{ asset('assets/plugins/magnific-popup/jquery.magnific.popup.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,

          fixedContentPos: false
        });
      });
</script>
@endsection
@endsection