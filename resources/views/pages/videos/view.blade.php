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
                                                <img src="{{ $video->image_url }}" width="760" height="350" class="img-fluid call-imgs" alt="Logo">
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
                    @can(\App\Models\PermissionSet::PERMISSION_COMMENTS_VIEW)
                    <div class="widget blog-comments clearfix">
                        <h3>Comments</h3>
                        <div class="drop-scroll msg-list-scroll" id="msg_list">
                            <ul class="list-box">
                                @forelse($comments as $key=>$comment)
                                <li>
                                    <div class="list-item">
                                        <div class="comment-block">
                                            <div class="comment-by">
                                                <div class="week-group">
                                                    <div class="d-flex">
                                                        <a href="#"><img class="avatar" alt="" src="{{ asset('assets/img/user.jpg')}}"></a>
                                                        <div>
                                                            <h5 class="blog-author-name mt-2">{{ $comment->user_name }}</h5>
                                                            <span class="week-list">{{ Carbon::createFromFormat('Y-m-d H:i:s', $comment->createddate)->diffForHumans() }}</span>
                                                            <a href="#" class="dropdown-toggle " data-bs-toggle="dropdown"><i class="feather-message-square"></i> {{ count($comment->replies) }} replies</a>
                                                            <div class="dropdown-menu notifications">
                                                                <div class="topnav-dropdown-header">
                                                                    <span>Replies</span>
                                                                </div>
                                                                <div class="drop-scroll msg-list-scroll">
                                                                    <ul class="list-box">
                                                                        @forelse($comment->replies as $reply)
                                                                        <li>
                                                                            <a href="#">
                                                                                <div class="list-item">
                                                                                    <div class="list-left">
                                                                                        <span class="avatar"><img alt="{{ $reply->user_name }}" src="{{ asset('assets/img/user.jpg')}}" class="img-fluid"></span>
                                                                                    </div>
                                                                                    <div class="list-body">
                                                                                        <span class="message-author">{{ $reply->user_name }}</span>
                                                                                        <a class="message-time text-danger" href="#." data-bs-toggle="modal" data-bs-target="#delete_modal{{ $reply->id }}"><i class="fa fa-trash"></i> Delete</a>
                                                                                        <div class="clearfix"></div>
                                                                                        <span class="message-content">{{ $reply->comment }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                        @empty
                                                                        <li><a href="#" class="text-center mt-5">No Replies</a></li>
                                                                        @endforelse
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="float-end">
                                                    <span class="blog-reply"><a href="#." class="text-info" data-bs-toggle="modal" data-bs-target="#reply_modal{{ $comment->id }}"><i class="fa fa-reply"></i> Reply</a></span>
                                                    <span class="blog-reply"><a href="#." data-bs-toggle="modal" data-bs-target="#delete_modal{{ $comment->id }}"><i class="fa fa-trash"></i> Delete</a></span>
                                                </span>
                                                <div id="reply_modal{{ $comment->id }}" class="modal custom-modal fade" role="dialog">
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
                                                <div id="delete_modal{{ $comment->id }}" class="modal custom-modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('assets/img/sent.png')}}" alt="" width="50" height="46">
                                                                <h3>Are you sure want to delete this ?</h3>
                                                                <form action="{{ route('comment.delete') }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" id="">
                                                                    <input type="hidden" name="video_id" value="{{ $video->id }}" id="">
                                                                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6>{{ $comment->comment }}</h6>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li>
                                    <h4 class="text-secondary text-center">No Comment</h4>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            <aside class="col-md-4">
                <div class="widget post-widget">
                    <div class="relat-head">
                        <h5>Recent Videos</h5>
                    </div>
                    <ul class="latest-posts">
                        @foreach($recent as $key=>$recent_video)
                        <li>
                            <div class="post-thumb">
                                <a href="{{ route('video.details', $recent_video->id)}}">
                                    <img class="img-fluid" src="{{ $recent_video->image_url }}" alt="">
                                </a>
                            </div>
                            <div class="post-info">
                                <div class="date-posts">
                                    <h5>{{ $recent_video->name }}</h5>
                                    <span class="ms-2">{{ date('d F Y',strtotime($recent_video->created_at)) }}</span>
                                </div>
                                <h4>
                                    <a href="{{ route('video.details', $recent_video->id)}}">{{ str_pad($recent_video->description,0,20) }}...</a>
                                </h4>
                                <a href="{{ route('video.details', $recent_video->id)}}"> View <i class="fa fa-long-arrow-right ms-2"></i></a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
            @can(\App\Models\PermissionSet::PERMISSION_COMMENT_ADD)
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
                                    <input class="form-control" type="hidden" name="video_id" value="{{ $video->name }}">
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
            @endcan
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