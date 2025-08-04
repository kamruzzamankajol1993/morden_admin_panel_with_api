@php
     $usr = Auth::user();
 @endphp

 <aside class="sidebar-container" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 fs-4 fw-bold d-flex align-items-center justify-content-center">
                <img src="{{asset('/')}}{{$icon}}" alt="Logo" class="sidebar-logo me-2">
                <span>{{$ins_name}}</span>
            </div>
            
            <div class="list-group list-group-flush my-3" id="sidebar-nav-accordion">
                 @if ($usr->can('dashboardView'))
                <a href="{{route('home')}}" class="list-group-item list-group-item-action {{ Route::is('home')  ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                @endif

                <a href="#salesSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-money-bill-wave me-2"></i>Sales</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="salesSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-shopping-cart me-2"></i>Orders</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-file-invoice-dollar me-2"></i>Invoices</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-truck-fast me-2"></i>Shipments</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-undo me-2"></i>Returns</a>
                    </div>
                </div>

                <a href="#catalogSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-book-open me-2"></i>Catalog</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="catalogSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="products.html" class="list-group-item list-group-item-action"><i class="fas fa-box-open me-2"></i>Products</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-tags me-2"></i>Categories</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-copyright me-2"></i>Brands</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-star me-2"></i>Reviews</a>
                    </div>
                </div>

                <a href="#customerSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-users me-2"></i>Customers</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="customerSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-friends me-2"></i>Customer List</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-tag me-2"></i>Customer Groups</a>
                    </div>
                </div>
                
                <a href="#reportsSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-chart-pie me-2"></i>Reports</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="reportsSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-chart-line me-2"></i>Sales Reports</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-chart-bar me-2"></i>Product Reports</a>
                    </div>
                </div>

                <a href="#settingsSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-cogs me-2"></i>Settings</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="settingsSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-wrench me-2"></i>General</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-shield me-2"></i>Users & Roles</a>
                    </div>
                </div>

                <a href="#settingsSubmenu1" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-cogs me-2"></i>Settings</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="settingsSubmenu1" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-wrench me-2"></i>General</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-shield me-2"></i>Users & Roles</a>
                    </div>
                </div>

                <a href="#settingsSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-cogs me-2"></i>Settings</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="settingsSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-wrench me-2"></i>General</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-shield me-2"></i>Users & Roles</a>
                    </div>
                </div>

                <a href="#settingsSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-cogs me-2"></i>Settings</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="settingsSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-wrench me-2"></i>General</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-shield me-2"></i>Users & Roles</a>
                    </div>
                </div>

                <a href="#settingsSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-cogs me-2"></i>Settings</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="settingsSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-wrench me-2"></i>General</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-shield me-2"></i>Users & Roles</a>
                    </div>
                </div>

                <a href="#settingsSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-cogs me-2"></i>Settings</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="settingsSubmenu" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-wrench me-2"></i>General</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-shield me-2"></i>Users & Roles</a>
                    </div>
                </div>
@if ( $usr->can('userAdd') || $usr->can('userView') ||  $usr->can('userDelete') ||  $usr->can('userUpdate') || $usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate') || $usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))
                <a href="#settingsSubmenuTwo" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{Route::is('designation.index') || Route::is('designation.edit') || Route::is('designation.create')|| Route::is('users.index') || Route::is('users.edit') || Route::is('users.create') || Route::is('branch.index') || Route::is('branch.edit') || Route::is('branch.create') ? 'active' : '' }}">
                    <div><i class="fas fa-cogs me-2"></i>Account Setting</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="settingsSubmenuTwo" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">
                       

                         @if ($usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate'))

                        <a class="list-group-item list-group-item-action {{ Route::is('designation.index') || Route::is('designation.edit') || Route::is('designation.create') ? 'active' : '' }}" href="{{ route('designation.index') }}">Designation</a>
                   
                    @endif


                          @if ($usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))
                   
                        <a class="list-group-item list-group-item-action {{ Route::is('branch.index') || Route::is('branch.edit') || Route::is('branch.create') ? 'active' : '' }}" href="{{ route('branch.index') }}">Branch/Agent Organization</a>
                    
                    @endif 
                   

                    @if ($usr->can('userAdd') || $usr->can('userView') ||  $usr->can('userDelete') ||  $usr->can('userUpdate'))
                    
                        <a class="list-group-item list-group-item-action {{ Route::is('users.show') || Route::is('users.index') || Route::is('users.edit') || Route::is('users.create') ? 'active' : '' }}" href="{{ route('users.index') }}">Partner Management</a>
                    
                    @endif
                    </div>
                </div>
                @endif

                 @if ($usr->can('permissionAdd') || $usr->can('permissionView') ||  $usr->can('permissionDelete') ||  $usr->can('permissionUpdate') || $usr->can('roleAdd') || $usr->can('roleView') ||  $usr->can('roleUpdate') ||  $usr->can('roleDelete') || $usr->can('panelSettingAdd') || $usr->can('panelSettingView') ||  $usr->can('panelSettingDelete') ||  $usr->can('panelSettingUpdate'))

                <a href="#settingsSubmenuOne" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{Route::is('roles.show') || Route::is('permissions.index') || Route::is('permissions.edit') || Route::is('permissions.create') || Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.create') || Route::is('systemInformation.index') || Route::is('systemInformation.edit') || Route::is('systemInformation.create') ? 'active' : '' }}">
                    <div><i class="fas fa-cogs me-2"></i>General Setting</div><i class="fas fa-chevron-down dropdown-indicator"></i>
                </a>
                <div class="collapse" id="settingsSubmenuOne" data-bs-parent="#sidebar-nav-accordion">
                    <div class="list-group-submenu">


                                 @if ($usr->can('panelSettingAdd') || $usr->can('panelSettingView') ||  $usr->can('panelSettingDelete') ||  $usr->can('panelSettingUpdate'))
                   
                        <a class="list-group-item list-group-item-action {{ Route::is('systemInformation.index') || Route::is('systemInformation.edit') || Route::is('systemInformation.create') ? 'active' : '' }}" href="{{ route('systemInformation.index') }}">Panel Settings</a>
                    
                    @endif

                    @if ($usr->can('roleAdd') || $usr->can('roleView') ||  $usr->can('roleEdit') ||  $usr->can('roleDelete'))
                   
                        <a class="list-group-item list-group-item-action {{Route::is('roles.show') || Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.create') ? 'active' : '' }}" href="{{ route('roles.index') }}">Role Management</a>
                    
                    @endif

                    @if ($usr->can('permissionAdd') || $usr->can('permissionView') ||  $usr->can('permissionDelete') ||  $usr->can('permissionUpdate'))
                   
                        <a class="list-group-item list-group-item-action {{ Route::is('permissions.index') || Route::is('permissions.edit') || Route::is('permissions.create') ? 'active' : '' }}" href="{{ route('permissions.index') }}">Permission Management</a>
                    
                    @endif
                    </div>
                </div>
                @endif

              
            </div>
        </aside>

 