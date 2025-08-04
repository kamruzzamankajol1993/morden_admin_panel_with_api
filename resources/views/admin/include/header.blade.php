@php
     $usr = Auth::user();
 @endphp

 <header class="navbar navbar-expand-lg navbar-light py-3 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="ms-auto d-flex align-items-center header-right-items">
                        <div id="datetime-display" class="fw-bold me-3"></div>
                        <a href="{{url('/clear')}}" class="btn btn-danger btn-sm me-3"><i class="fas fa-broom me-1"></i> Clear Cache</a>
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle second-text fw-bold d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">


                                     @if(empty(Auth::user()->image))
                    <img src="{{asset('/')}}public/No_Image_Available.jpg" alt="Image" class="rounded-circle me-2 user-avatar">
                    @else
                    <img src="{{asset('/')}}{{ Auth::user()->image }}" alt="Image" class="rounded-circle me-2 user-avatar">
                    @endif
                 
                                    {{Auth::user()->name}}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                 

                            @if ($usr->can('profileView'))
                                    <li><a class="dropdown-item" href="{{ route('profileView') }}"><i class="fas fa-user-circle fa-fw me-2"></i>Profile</a></li>
                                                          @endif
                            @if ($usr->can('profileSetting'))
                                   
                                    <li><a class="dropdown-item" href="{{ route('profileSetting') }}"><i class="fas fa-cog fa-fw me-2"></i>Settings</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                      document.getElementById('admin-logout-form').submit();"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout</a></li>
                      <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>


