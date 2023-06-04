<header>

    <div class="topbar d-flex align-items-center">
        
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            
           

            <div class="dashboardTitle">
                <h3 >Vendor Dashboard</h3>
            </div>



            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    {{-- <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#">	<i class='bx bx-search'></i>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class='bx bx-category'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="row row-cols-3 g-3 p-3">
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-group'></i>
                                    </div>
                                    <div class="app-title">Teams</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-atom'></i>
                                    </div>
                                    <div class="app-title">Projects</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
                                    </div>
                                    <div class="app-title">Tasks</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-notification'></i>
                                    </div>
                                    <div class="app-title">Feeds</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
                                    </div>
                                    <div class="app-title">Files</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-filter-alt'></i>
                                    </div>
                                    <div class="app-title">Alerts</div>
                                </div>
                            </div>
                        </div>
                    </li> --}}
                    
                    



                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <span class="alert-count">
                            
                                @php
                                $notification_count = Auth::user()->unreadNotifications()->count();
                                @endphp
                                {{$notification_count}}
                            </span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                    
                                </div>
                            </a>


                            <div class="header-notifications-list">
                                @php
                                    $user = Auth::user();
                                @endphp

                                @forelse ($user->notifications as $notification)
                                
                                @if($notification->read_at == null)
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Message<span class="msg-time float-end">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span></h6>
                                            <p class="msg-info">{{$notification->data['message']}}</p>
                                        </div>
                                    </div>
                                </a>
                                @else
                                <a class="dropdown-item" href="javascript:;" style="background-color: lightgray">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-warning text-secondary"><i class="bx bx-send"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Message<span class="msg-time float-end">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span></h6>
                                            <p class="msg-info">{{$notification->data['message']}}</p>
                                        </div>
                                    </div>
                                </a>
                                @endif
                                @empty
                                    
                                @endforelse
                            </div>
                            <a href="{{route('mark.read.notification')}}">
                                <div class="text-center msg-footer">Mark All As Read</div>
                            </a>
                        </div>
                    </li>





                    <li class="nav-item dropdown dropdown-large" style="display: none;">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                            <i class='bx bx-comment'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            
                            <div class="header-message-list">
                                
                            </div>
                            
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('images/icons/person-circle.svg')}}" class="user-img" alt="user avatar">

                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->boutiqueName }}</p>
                        <p class="designattion mb-0">{{ Auth::user()->role }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('vendor.profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{route('vendor.change.password')}}"><i class="bx bx-cog"></i><span>Change Password</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('vendor.logout') }}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>