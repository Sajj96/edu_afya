<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{ route('home') }}" @if(\Request::is('home') || \Request::is('home/*') ) class="active" @endif><span class="menu-side"><img src="{{ asset('assets/img/icons/menu-icon-01.svg') }}" alt=""></span> <span>
                            Dashboard </span></a>
                </li>
                @if(auth()->user()->can(\App\Models\PermissionSet::PERMISSION_DOCTORS_VIEW))
                <li class="submenu">
                    <a href="javascript:void(0);"><span class="menu-side"><img src="{{ asset('assets/img/icons/menu-icon-02.svg') }}" alt=""></span> <span>Doctors</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="submenu">
                            <a href="javascript:void(0);"><span>Categories</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a @if(\Request::is('doctor-categories') ) class="active" @endif href="{{ route('doctor.category') }}"><span>Categories List</span></a></li>
                                <li><a @if(\Request::is('doctor-categories/create') ) class="active" @endif href="{{ route('doctor.category.create') }}"><span>Add Category</span></a></li>
                            </ul>
                        </li>
                        <li><a @if(\Request::is('doctors') ) class="active" @endif href="{{ route('doctor') }}">Doctors List</a></li>
                        <li><a @if(\Request::is('doctors/*') ) class="active" @endif href="{{ route('doctor.create') }}">Add Doctor</a></li>
                    </ul>
                </li>
                @endif
                @if(auth()->user()->can(\App\Models\PermissionSet::PERMISSION_USER_ADD) ||
                auth()->user()->can(\App\Models\PermissionSet::PERMISSION_USERS_VIEW))
                <li class="submenu">
                    <a href="#"><span class="menu-side"><img src="{{ asset('assets/img/icons/menu-icon-03.svg') }}" alt=""></span>
                        <span>Users </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a @if(\Request::is('users') ) class="active" @endif href="{{ route('user') }}">Users List</a></li>
                        <li><a @if(\Request::is('users/*') ) class="active" @endif href="{{ route('user.create') }}">Add User</a></li>
                    </ul>
                </li>
                @endif
                @if(auth()->user()->can(\App\Models\PermissionSet::PERMISSION_ROLE_ADD) ||
                auth()->user()->can(\App\Models\PermissionSet::PERMISSION_ROLES_VIEW))
                <li class="submenu">
                    <a href="#"><span class="menu-side"><i class="feather-shield"></i></span>
                        <span>Roles </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        @can(\App\Models\PermissionSet::PERMISSION_ROLES_VIEW)
                        <li><a @if(\Request::is('roles') ) class="active" @endif href="{{ route('role') }}">Roles List</a></li>
                        @endcan
                        @can(\App\Models\PermissionSet::PERMISSION_ROLE_ADD)
                        <li><a @if(\Request::is('roles/*') ) class="active" @endif href="{{ route('role.create') }}">Add Role</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if(auth()->user()->can(\App\Models\PermissionSet::PERMISSION_CHAT_ADD) ||
                auth()->user()->can(\App\Models\PermissionSet::PERMISSION_CHATS_VIEW))
                <li>
                    <a href="{{ route('chat') }}" @if(\Request::is('chats') || \Request::is('chats/*') ) class="active" @endif><span class="menu-side"><img src="{{ asset('assets/img/icons/menu-icon-10.svg') }}" alt=""></span> <span>Chats</span></a>
                </li>
                @endif
                @if(auth()->user()->can(\App\Models\PermissionSet::PERMISSION_SUBSCRIPTION_ADD) ||
                auth()->user()->can(\App\Models\PermissionSet::PERMISSION_SUBSCRIPTIONS_VIEW))
                <li class="submenu">
                    <a href="#"><span class="menu-side"><img src="{{ asset('assets/img/icons/menu-icon-09.svg') }}" alt=""></span>
                        <span>Subscriptions </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        @can(\App\Models\PermissionSet::PERMISSION_SUBSCRIPTION_ADD)
                        <li><a @if(\Request::is('subcriptions/plans') ) class="active" @endif href="{{ route('subscription') }}">Plans</a></li>
                        @endcan
                        @can(\App\Models\PermissionSet::PERMISSION_SUBSCRIPTIONS_VIEW)
                        <li><a @if(\Request::is('subcriptions/app') ) class="active" @endif href="{{ route('subscription.app') }}">App</a></li>
                        @endcan
                        @can(\App\Models\PermissionSet::PERMISSION_SUBSCRIPTIONS_VIEW)
                        <li><a @if(\Request::is('subcriptions/doctor') ) class="active" @endif href="{{ route('subscription.doctor') }}">Consultations</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @if(auth()->user()->can(\App\Models\PermissionSet::PERMISSION_ROLE_ADD) ||
                auth()->user()->can(\App\Models\PermissionSet::PERMISSION_ROLES_VIEW))
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="feather-video"></i> <span>Videos</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        @if(auth()->user()->can(\App\Models\PermissionSet::PERMISSION_CATEGORY_ADD) ||
                        auth()->user()->can(\App\Models\PermissionSet::PERMISSION_CATEGORIES_VIEW))
                        <li class="submenu">
                            <a href="javascript:void(0);"><span>Categories</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                @can(\App\Models\PermissionSet::PERMISSION_CATEGORIES_VIEW)
                                <li><a @if(\Request::is('video-categories') ) class="active" @endif href="{{ route('video.category') }}">Categories List</a></li>
                                @endcan
                                @can(\App\Models\PermissionSet::PERMISSION_CATEGORY_ADD)
                                <li><a @if(\Request::is('video-categories/create') ) class="active" @endif href="{{ route('video.category.create') }}">Add Category</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                        @can(\App\Models\PermissionSet::PERMISSION_VIDEOS_VIEW)
                        <li><a @if(\Request::is('videos') ) class="active" @endif href="{{ route('video') }}">Videos List</a></li>
                        @endcan
                        @can(\App\Models\PermissionSet::PERMISSION_VIDEO_ADD)
                        <li><a @if(\Request::is('videos/*') ) class="active" @endif href="{{ route('video.create') }}">Add Video</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                <li class="submenu">
                    <a href="#"><span class="menu-side"><i class="feather-image"></i></span>
                        <span>Banners </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a @if(\Request::is('banners') ) class="active" @endif href="{{ route('banner') }}">Banners List</a></li>
                        <li><a @if(\Request::is('banners/*') ) class="active" @endif href="{{ route('banner.create') }}">Add Banner</a></li>
                    </ul>
                </li>
                <!-- @if(auth()->user()->can(\App\Models\PermissionSet::PERMISSION_REPORT_ADD) ||
                auth()->user()->can(\App\Models\PermissionSet::PERMISSION_REPORTS_VIEW))
                <li>
                    <a href="{{ route('report') }}"><i class="fa fa-flag"></i> <span> Reports </span> </a>
                </li>
                @endif -->
            </ul>
            <div class="logout-btn">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="menu-side"><img src="{{ asset('assets/img/icons/logout.svg') }}" alt=""></span>
                    <span>Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>