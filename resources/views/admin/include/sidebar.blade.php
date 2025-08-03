@php
     $usr = Auth::user();
 @endphp
<aside class="sidebar" >
    <!-- sidebar close btn -->
     <button type="button" class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i class="ph ph-x"></i></button>
    <!-- sidebar close btn -->
    
    <a href="{{route('home')}}" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
        <img src="{{asset('/')}}{{$logo}}" alt="Logo">
    </a>

    <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
        <div class="p-20 pt-10">
            <ul class="sidebar-menu">
                @if ($usr->can('dashboardView'))
                <li class="sidebar-menu__item {{ Route::is('home')  ? 'activePage' : '' }}">
                    <a href="{{route('home')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                @endif

@if ( $usr->can('ticketAdd'))
                <li class="sidebar-menu__item">
                    <span style="color: white !important;font-weight:bold !important;" class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">Custome Ticket</span>
                </li>

                  @if ( $usr->can('ticketAdd'))
                <li class="sidebar-menu__item {{ Route::is('ticket.create')  ? 'activePage' : '' }}">
                    <a href="{{route('ticket.create')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-ticket"></i></span>
                        <span class="text"> Create Ticket</span>
                    </a>
                </li>
                @endif

               

                @if (  $usr->can('ticketView') ||  $usr->can('ticketDelete') ||  $usr->can('ticketUpdate'))
                <li class="sidebar-menu__item {{ Route::is('ticket.index') || Route::is('ticket.edit')  ? 'activePage' : '' }}">
                    <a href="{{route('ticket.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-file-text"></i></span>
                        <span class="text">Ticket List</span>
                    </a>
                </li>
                @endif
                @endif

                <li class="sidebar-menu__item">
                    <span style="color: white !important;font-weight:bold !important;" class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">General Ticket</span>
                </li>

                  @if ( $usr->can('generalTicketAdd'))
                <li class="sidebar-menu__item {{ Route::is('generalTicket.create')  ? 'activePage' : '' }}">
                    <a href="{{route('generalTicket.create')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-ticket"></i></span>
                        <span class="text"> Create Ticket</span>
                    </a>
                </li>
                @endif

               

                @if (  $usr->can('generalTicketView') ||  $usr->can('generalTicketDelete') ||  $usr->can('generalTicketUpdate'))
                <li class="sidebar-menu__item {{ Route::is('generalTicket.index') || Route::is('generalTicket.edit')  ? 'activePage' : '' }}">
                    <a href="{{route('generalTicket.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-file-text"></i></span>
                        <span class="text">Ticket List</span>
                    </a>
                </li>
                @endif


                <li class="sidebar-menu__item">
                    <span style="color: white !important;font-weight:bold !important;" class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">Customer</span>
                </li>

                 @if ( $usr->can('customerAdd') || $usr->can('customerView') ||  $usr->can('customerDelete') ||  $usr->can('customerUpdate'))
                <li class="sidebar-menu__item {{ Route::is('customer.index') || Route::is('customer.edit') || Route::is('customer.create')  ? 'activePage' : '' }}">
                    <a href="{{route('customer.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-user-plus"></i></span>
                        <span class="text">Customer List</span>
                    </a>
                </li>
                @endif
     @if ( $usr->can('offerAdd') || $usr->can('offerView') ||  $usr->can('offerDelete') ||  $usr->can('offerUpdate'))
                <li class="sidebar-menu__item">
                    <span style="color: white !important;font-weight:bold !important;" class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">Offer & Service</span>
                </li>

                @if ( $usr->can('offerAdd') || $usr->can('offerView') ||  $usr->can('offerDelete') ||  $usr->can('offerUpdate'))
                <li class="sidebar-menu__item {{ Route::is('offer.index') || Route::is('offer.edit') || Route::is('offer.create')  ? 'activePage' : '' }}">
                    <a href="{{route('offer.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-airplane"></i></span>
                        <span class="text">Offer List</span>
                    </a>
                </li>
                @endif

                @if ( $usr->can('serviceAdd') || $usr->can('serviceView') ||  $usr->can('serviceDelete') ||  $usr->can('serviceUpdate'))
                <li class="sidebar-menu__item {{ Route::is('service.index') || Route::is('service.edit') || Route::is('service.create')  ? 'activePage' : '' }}">
                    <a href="{{route('service.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-airplane"></i></span>
                        <span class="text">Service List</span>
                    </a>
                </li>
                @endif
                @endif
  @if ( $usr->can('aircraftAdd') || $usr->can('aircraftView') ||  $usr->can('aircraftDelete') ||  $usr->can('aircraftUpdate'))
                <li class="sidebar-menu__item">
                    <span style="color: white !important;font-weight:bold !important;" class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">Aircraft</span>
                </li>

                 @if ( $usr->can('aircraftAdd') || $usr->can('aircraftView') ||  $usr->can('aircraftDelete') ||  $usr->can('aircraftUpdate'))
                <li class="sidebar-menu__item {{ Route::is('aircraft.index') || Route::is('aircraft.edit') || Route::is('aircraft.create')  ? 'activePage' : '' }}">
                    <a href="{{route('aircraft.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-airplane"></i></span>
                        <span class="text">Aircraft Name</span>
                    </a>
                </li>
                @endif

                @if ( $usr->can('aircraftModeltypeAdd') || $usr->can('aircraftModeltypeView') ||  $usr->can('aircraftModeltypeDelete') ||  $usr->can('aircraftModeltypeUpdate'))
                <li class="sidebar-menu__item {{ Route::is('aircraftModeltype.index') || Route::is('aircraftModeltype.edit') || Route::is('aircraftModeltype.create')  ? 'activePage' : '' }}">
                    <a href="{{route('aircraftModeltype.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-airplane-tilt"></i></span>
                        <span class="text">Aircraft Model Type </span>
                    </a>
                </li>
                @endif

                 @if ( $usr->can('aircraftAvailableAdd') || $usr->can('aircraftAvailableView') ||  $usr->can('aircraftAvailableDelete') ||  $usr->can('aircraftAvailableUpdate'))
                <li class="sidebar-menu__item {{ Route::is('aircraftAvailable.index') || Route::is('aircraftAvailable.edit') || Route::is('aircraftAvailable.create')  ? 'activePage' : '' }}">
                    <a href="{{route('aircraftAvailable.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-airplane-taxiing"></i></span>
                        <span class="text">Aircraft Availablility </span>
                    </a>
                </li>
                @endif

                @if ( $usr->can('flightTypeAdd') || $usr->can('flightTypeView') ||  $usr->can('flightTypeDelete') ||  $usr->can('flightTypeUpdate'))
                <li class="sidebar-menu__item {{ Route::is('flightType.index') || Route::is('flightType.edit') || Route::is('flightType.create')  ? 'activePage' : '' }}">
                    <a href="{{route('flightType.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-airplane-in-flight"></i></span>
                        <span class="text">Flight Type</span>
                    </a>
                </li>
                @endif

                @if ( $usr->can('holidayCalenderAdd') || $usr->can('holidayCalenderView') ||  $usr->can('holidayCalenderDelete') ||  $usr->can('holidayCalenderUpdate'))
                <li class="sidebar-menu__item {{ Route::is('holidayCalender.index') || Route::is('holidayCalender.edit') || Route::is('holidayCalender.create')  ? 'activePage' : '' }}">
                    <a href="{{route('holidayCalender.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-calendar-dots"></i></span>
                        <span class="text">Holiday Calender</span>
                    </a>
                </li>
                @endif
                @endif
  @if ($usr->can('bannerAdd') || $usr->can('bannerView') ||  $usr->can('bannerDelete') ||  $usr->can('bannerUpdate'))
                <li class="sidebar-menu__item">
                    <span style="color: white !important;font-weight:bold !important;" class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">WebSite Section</span>
                </li>


                <li class="sidebar-menu__item has-dropdown {{Route::is('message.index') || Route::is('message.edit') || Route::is('message.create')|| Route::is('extraPage.index') || Route::is('extraPage.edit') || Route::is('extraPage.create')|| Route::is('blog.index') || Route::is('blog.edit') || Route::is('blog.create')|| Route::is('socialLink.index') || Route::is('socialLink.edit') || Route::is('socialLink.create')|| Route::is('gallery.index') || Route::is('gallery.edit') || Route::is('gallery.create')|| Route::is('newsAndMedia.index') || Route::is('newsAndMedia.edit') || Route::is('newsAndMedia.create')|| Route::is('banner.index') || Route::is('banner.edit') || Route::is('banner.create')|| Route::is('clientSay.index') || Route::is('clientSay.edit') || Route::is('clientSay.create') || Route::is('review.index') || Route::is('review.edit') || Route::is('review.create') ? 'activePage' : '' }}">
                    <a href="javascript:void(0)" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-folder"></i></span>
                        <span class="text">Website Content</span>
                    </a>
                    <!-- Submenu start -->
                    <ul class="sidebar-submenu">

                        @if ($usr->can('bannerAdd') || $usr->can('bannerView') ||  $usr->can('bannerDelete') ||  $usr->can('bannerUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('banner.index') || Route::is('banner.edit') || Route::is('banner.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('banner.index') || Route::is('banner.edit') || Route::is('banner.create') ? 'activePage' : '' }}" href="{{ route('banner.index') }}">Banner</a>
                    </li>
                    @endif 
 @if ($usr->can('clientSayAdd') || $usr->can('clientSayView') ||  $usr->can('clientSayDelete') ||  $usr->can('clientSayUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('clientSay.index') || Route::is('clientSay.edit') || Route::is('clientSay.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('clientSay.index') || Route::is('clientSay.edit') || Route::is('clientSay.create') ? 'activePage' : '' }}" href="{{ route('clientSay.index') }}">Client Say</a>
                    </li>
                    @endif 

                     @if ($usr->can('reviewAdd') || $usr->can('reviewView') ||  $usr->can('reviewDelete') ||  $usr->can('reviewUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('review.index') || Route::is('review.edit') || Route::is('review.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('review.index') || Route::is('review.edit') || Route::is('review.create') ? 'activePage' : '' }}" href="{{ route('review.index') }}">Review</a>
                    </li>
                    @endif

                    @if ($usr->can('newsAndMediaAdd') || $usr->can('newsAndMediaView') ||  $usr->can('newsAndMediaDelete') ||  $usr->can('newsAndMediaUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('newsAndMedia.index') || Route::is('newsAndMedia.edit') || Route::is('newsAndMedia.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('newsAndMedia.index') || Route::is('newsAndMedia.edit') || Route::is('newsAndMedia.create') ? 'activePage' : '' }}" href="{{ route('newsAndMedia.index') }}">News & Media</a>
                    </li>
                    @endif 

                    @if ($usr->can('galleryAdd') || $usr->can('galleryView') ||  $usr->can('galleryDelete') ||  $usr->can('galleryUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('gallery.index') || Route::is('gallery.edit') || Route::is('gallery.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('gallery.index') || Route::is('gallery.edit') || Route::is('gallery.create') ? 'activePage' : '' }}" href="{{ route('gallery.index') }}">Gallery</a>
                    </li>
                    @endif

                    @if ($usr->can('socialLinkAdd') || $usr->can('socialLinkView') ||  $usr->can('socialLinkDelete') ||  $usr->can('socialLinkUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('socialLink.index') || Route::is('socialLink.edit') || Route::is('socialLink.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('socialLink.index') || Route::is('socialLink.edit') || Route::is('socialLink.create') ? 'activePage' : '' }}" href="{{ route('socialLink.index') }}">Social Link</a>
                    </li>
                    @endif

                    @if ($usr->can('blogAdd') || $usr->can('blogView') ||  $usr->can('blogDelete') ||  $usr->can('blogUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('blog.index') || Route::is('blog.edit') || Route::is('blog.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('blog.index') || Route::is('blog.edit') || Route::is('blog.create') ? 'activePage' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    @endif
                    @if ($usr->can('extraPageAdd') || $usr->can('extraPageView') ||  $usr->can('extraPageDelete') ||  $usr->can('extraPageUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('extraPage.index') || Route::is('extraPage.edit') || Route::is('extraPage.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('extraPage.index') || Route::is('extraPage.edit') || Route::is('extraPage.create') ? 'activePage' : '' }}" href="{{ route('extraPage.index') }}">Extra Page</a>
                    </li>
                    @endif

                        @if ($usr->can('messageAdd') || $usr->can('messageView') ||  $usr->can('messageDelete') ||  $usr->can('messageUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('message.index') || Route::is('message.edit') || Route::is('message.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('message.index') || Route::is('message.edit') || Route::is('message.create') ? 'activePage' : '' }}" href="{{ route('message.index') }}">Message</a>
                    </li>
                    @endif

                    @if ($usr->can('aboutUsAdd') || $usr->can('aboutUsView') ||  $usr->can('aboutUsDelete') ||  $usr->can('aboutUsUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('aboutUs.index') || Route::is('aboutUs.edit') || Route::is('aboutUs.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('aboutUs.index') || Route::is('aboutUs.edit') || Route::is('aboutUs.create') ? 'activePage' : '' }}" href="{{ route('aboutUs.index') }}">About Us</a>
                    </li>
                    @endif


                     @if ($usr->can('contactAdd') || $usr->can('contactView') ||  $usr->can('contactDelete') ||  $usr->can('contactUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('contact.index') || Route::is('contact.edit') || Route::is('contact.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('contact.index') || Route::is('contact.edit') || Route::is('contact.create') ? 'activePage' : '' }}" href="{{ route('contact.index') }}">Contact Info</a>
                    </li>
                    @endif


                          
                    </ul>
                    <!-- Submenu End -->
                </li>

                @endif


                <li class="sidebar-menu__item">
                    <span style="color: white !important;font-weight:bold !important;" class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">Settings</span>
                </li>
                 @if ( $usr->can('couponAdd') || $usr->can('couponView') ||  $usr->can('couponDelete') ||  $usr->can('couponUpdate'))
                <li class="sidebar-menu__item {{ Route::is('coupon.create')  ? 'activePage' : '' }}">
                    <a href="{{route('coupon.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-tag-simple"></i></span>
                        <span class="text">Coupon</span>
                    </a>
                </li>
                @endif

                @if ( $usr->can('defaultLocationAdd') || $usr->can('defaultLocationView') ||  $usr->can('defaultLocationDelete') ||  $usr->can('defaultLocationUpdate'))
                <li class="sidebar-menu__item {{ Route::is('defaultLocation.create')  ? 'activePage' : '' }}">
                    <a href="{{route('defaultLocation.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-map-pin-line"></i></span>
                        <span class="text"> Default Location</span>
                    </a>
                </li>
                @endif

                @if ( $usr->can('searchLogAdd') || $usr->can('searchLogView') ||  $usr->can('searchLogDelete') ||  $usr->can('searchLogUpdate'))
                <li class="sidebar-menu__item {{ Route::is('searchLog.create')  ? 'activePage' : '' }}">
                    <a href="{{route('searchLog.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-file-magnifying-glass"></i></span>
                        <span class="text">Search Log List</span>
                    </a>
                </li>
                @endif

                @if ( $usr->can('userAdd') || $usr->can('userView') ||  $usr->can('userDelete') ||  $usr->can('userUpdate') || $usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate') || $usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))
                <li class="sidebar-menu__item has-dropdown {{Route::is('designation.index') || Route::is('designation.edit') || Route::is('designation.create')|| Route::is('users.index') || Route::is('users.edit') || Route::is('users.create') || Route::is('branch.index') || Route::is('branch.edit') || Route::is('branch.create') ? 'activePage' : '' }}">
                    <a href="javascript:void(0)" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-gear"></i></span>
                        <span class="text">Account Settings</span>
                    </a>
                    <!-- Submenu start -->
                    <ul class="sidebar-submenu">

                        @if ($usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('designation.index') || Route::is('designation.edit') || Route::is('designation.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('designation.index') || Route::is('designation.edit') || Route::is('designation.create') ? 'activePage' : '' }}" href="{{ route('designation.index') }}">Designation</a>
                    </li>
                    @endif


                          @if ($usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('branch.index') || Route::is('branch.edit') || Route::is('branch.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('branch.index') || Route::is('branch.edit') || Route::is('branch.create') ? 'activePage' : '' }}" href="{{ route('branch.index') }}">Branch/Agent Organization</a>
                    </li>
                    @endif 
                   

                    @if ($usr->can('userAdd') || $usr->can('userView') ||  $usr->can('userDelete') ||  $usr->can('userUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('users.show') || Route::is('users.index') || Route::is('users.edit') || Route::is('users.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('users.show') || Route::is('users.index') || Route::is('users.edit') || Route::is('users.create') ? 'activePage' : '' }}" href="{{ route('users.index') }}">Partner Management</a>
                    </li>
                    @endif

                  


                      
                    </ul>
                    <!-- Submenu End -->
                </li>
@endif
                @if ($usr->can('permissionAdd') || $usr->can('permissionView') ||  $usr->can('permissionDelete') ||  $usr->can('permissionUpdate') || $usr->can('roleAdd') || $usr->can('roleView') ||  $usr->can('roleUpdate') ||  $usr->can('roleDelete') || $usr->can('panelSettingAdd') || $usr->can('panelSettingView') ||  $usr->can('panelSettingDelete') ||  $usr->can('panelSettingUpdate'))

                <li class="sidebar-menu__item has-dropdown {{Route::is('roles.show') || Route::is('permissions.index') || Route::is('permissions.edit') || Route::is('permissions.create') || Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.create') || Route::is('systemInformation.index') || Route::is('systemInformation.edit') || Route::is('systemInformation.create') ? 'activePage' : '' }}">
                    <a href="javascript:void(0)" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-gear"></i></span>
                        <span class="text">General Settings</span>
                    </a>
                    <!-- Submenu start -->
                    <ul class="sidebar-submenu">

                      

                    @if ($usr->can('panelSettingAdd') || $usr->can('panelSettingView') ||  $usr->can('panelSettingDelete') ||  $usr->can('panelSettingUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('systemInformation.index') || Route::is('systemInformation.edit') || Route::is('systemInformation.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('systemInformation.index') || Route::is('systemInformation.edit') || Route::is('systemInformation.create') ? 'activePage' : '' }}" href="{{ route('systemInformation.index') }}">Panel Settings</a>
                    </li>
                    @endif

                    @if ($usr->can('roleAdd') || $usr->can('roleView') ||  $usr->can('roleEdit') ||  $usr->can('roleDelete'))
                    <li class="sidebar-submenu__item {{Route::is('roles.show') || Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{Route::is('roles.show') || Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.create') ? 'activePage' : '' }}" href="{{ route('roles.index') }}">Role Management</a>
                    </li>
                    @endif

                    @if ($usr->can('permissionAdd') || $usr->can('permissionView') ||  $usr->can('permissionDelete') ||  $usr->can('permissionUpdate'))
                    <li class="sidebar-submenu__item {{ Route::is('permissions.index') || Route::is('permissions.edit') || Route::is('permissions.create') ? 'activePage' : '' }}">
                        <a class="sidebar-submenu__link {{ Route::is('permissions.index') || Route::is('permissions.edit') || Route::is('permissions.create') ? 'activePage' : '' }}" href="{{ route('permissions.index') }}">Permission Management</a>
                    </li>
                    @endif


                      
                    </ul>
                    <!-- Submenu End -->
                </li>
                @endif
                
            </ul>
        </div>
       
    </div>

</aside>   