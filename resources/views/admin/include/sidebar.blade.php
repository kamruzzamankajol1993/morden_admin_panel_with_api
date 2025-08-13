@php
     $usr = Auth::user();
 @endphp

 <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{asset('/')}}public/logo.png" alt="{{ $ins_name }} Logo" class="img-fluid">
            </div>
            <ul class="nav flex-column" id="sidebar-menu">
                 @if ($usr->can('dashboardView'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('home')  ? 'active' : '' }}" href="{{route('home')}}">
                        <i data-feather="grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @endif
                </li>
                <li class="nav-item">
                     <a class="nav-link" href="#ordersSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="ordersSubmenu">
                        <i data-feather="shopping-bag"></i>
                        <span>Orders</span>
                        <i data-feather="chevron-down" class="ms-auto"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="ordersSubmenu" data-bs-parent="#sidebar-menu">
                        <li><a class="nav-link" href="#">All Orders</a></li>
                        <li><a class="nav-link" href="#">Pending</a></li>
                        <li><a class="nav-link" href="#">Shipped</a></li>
                    </ul>
                </li>
                  @if ($usr->can('animationCategoryAdd') || $usr->can('animationCategoryView') ||  $usr->can('animationCategoryDelete') ||  $usr->can('animationCategoryUpdate') || $usr->can('brandAdd') || $usr->can('brandView') ||  $usr->can('brandDelete') ||  $usr->can('brandUpdate') || $usr->can('categoryAdd') || $usr->can('categoryView') ||  $usr->can('categoryDelete') ||  $usr->can('categoryUpdate') || $usr->can('productAdd') || $usr->can('productView') ||  $usr->can('productDelete') ||  $usr->can('productUpdate'))
                <li class="nav-item">
                    <a class="nav-link" href="#productsSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="productsSubmenu">
                        <i data-feather="tag"></i>
                        <span>Products</span>
                        <i data-feather="chevron-down" class="ms-auto"></i>
                    </a>
                    <ul class="collapse list-unstyled {{Route::is('barcode.index')|| Route::is('product.index') || Route::is('size-chart.index') || Route::is('unit.index') || Route::is('size.index') || Route::is('color.index') ||  Route::is('fabric.index') || Route::is('sub-subcategory.index') ||  Route::is('subcategory.index') || Route::is('animationCategory.index') || Route::is('animationCategory.edit') || Route::is('animationCategory.create') || Route::is('brand.show') || Route::is('brand.index') || Route::is('brand.edit') || Route::is('brand.create') || Route::is('category.index') || Route::is('category.edit') || Route::is('category.create') || Route::is('product.index') || Route::is('product.edit')|| Route::is('product.show') || Route::is('product.create') ? 'show' : '' }}" id="productsSubmenu" data-bs-parent="#sidebar-menu">
                           @if ($usr->can('productView') ||  $usr->can('productDelete') ||  $usr->can('productUpdate'))
                        <li><a class="nav-link {{ Route::is('product.index') || Route::is('product.edit') || Route::is('product.show') ? 'active' : '' }}" href="{{route('product.index')}}">Product List</a></li>
                        @endif
                      @if ($usr->can('productAdd'))
                        <li><a class="nav-link {{Route::is('product.create') ? 'active' : ''}}" href="{{route('product.create')}}">Add Product</a></li>
                        @endif
                         @if ($usr->can('brandAdd') || $usr->can('brandView') ||  $usr->can('brandDelete') ||  $usr->can('brandUpdate'))

                        <a class="nav-link {{ Route::is('brand.index') || Route::is('brand.edit') || Route::is('brand.create') ? 'active' : '' }}" href="{{ route('brand.index') }}">Brand</a>

                    @endif


                          @if ($usr->can('categoryAdd') || $usr->can('categoryView') ||  $usr->can('categoryDelete') ||  $usr->can('categoryUpdate'))

                        <a class="nav-link {{ Route::is('category.index') || Route::is('category.edit') || Route::is('category.create') ? 'active' : '' }}" href="{{ route('category.index') }}">Category</a>

                    @endif

                     @if ($usr->can('subcategoryAdd') || $usr->can('subcategoryView') ||  $usr->can('subcategoryDelete') ||  $usr->can('subcategoryUpdate'))

                        <a class="nav-link {{ Route::is('subcategory.index') || Route::is('subcategory.edit') || Route::is('subcategory.create') ? 'active' : '' }}" href="{{ route('subcategory.index') }}">Sub Category</a>

                    @endif

                                    @if ($usr->can('sub-subcategoryAdd') || $usr->can('sub-subcategoryView') ||  $usr->can('sub-subcategoryDelete') ||  $usr->can('sub-subcategoryUpdate'))

                        <a class="nav-link {{ Route::is('sub-subcategory.index') || Route::is('sub-subcategory.edit') || Route::is('sub-subcategory.create') ? 'active' : '' }}" href="{{ route('sub-subcategory.index') }}">Sub-subcategory</a>

                    @endif

                    @if ($usr->can('animationCategoryAdd') || $usr->can('animationCategoryView') ||  $usr->can('animationCategoryDelete') ||  $usr->can('animationCategoryUpdate'))

                        <a class="nav-link {{ Route::is('animationCategory.index') || Route::is('animationCategory.edit') || Route::is('animationCategory.create') ? 'active' : '' }}" href="{{ route('animationCategory.index') }}">Animation Category</a>

                    @endif

                                  @if ($usr->can('fabricAdd') || $usr->can('fabricView') ||  $usr->can('fabricDelete') ||  $usr->can('fabricUpdate'))

                        <a class="nav-link {{ Route::is('fabric.index') || Route::is('fabric.edit') || Route::is('fabric.create') ? 'active' : '' }}" href="{{ route('fabric.index') }}">Material</a>

                    @endif

                     @if ($usr->can('colorAdd') || $usr->can('colorView') ||  $usr->can('colorDelete') ||  $usr->can('colorUpdate'))

                        <a class="nav-link {{ Route::is('color.index') || Route::is('color.edit') || Route::is('color.create') ? 'active' : '' }}" href="{{ route('color.index') }}">Color</a>

                    @endif


                      @if ($usr->can('unitAdd') || $usr->can('unitView') ||  $usr->can('unitDelete') ||  $usr->can('unitUpdate'))

                        <a class="nav-link {{ Route::is('unit.index') || Route::is('unit.edit') || Route::is('unit.create') ? 'active' : '' }}" href="{{ route('unit.index') }}">Unit</a>

                    @endif

                     @if ($usr->can('sizeAdd') || $usr->can('sizeView') ||  $usr->can('sizeDelete') ||  $usr->can('sizeUpdate'))

                        <a class="nav-link {{ Route::is('size.index') || Route::is('size.edit') || Route::is('size.create') ? 'active' : '' }}" href="{{ route('size.index') }}">Size</a>

                    @endif

                    @if ($usr->can('sizeChartAdd') || $usr->can('sizeChartView') ||  $usr->can('sizeChartDelete') ||  $usr->can('sizeChartUpdate'))

                        <a class="nav-link {{ Route::is('size-chart.index') || Route::is('size-chart.edit') || Route::is('size-chart.create') ? 'active' : '' }}" href="{{ route('size-chart.index') }}">Size Chart</a>

                    @endif

                      @if ($usr->can('barcodeView'))

                        <a class="nav-link {{ Route::is('barcode.index')  ? 'active' : '' }}" href="{{ route('barcode.index') }}">Print Barcode</a>

                    @endif

                    </ul>
                </li>
                @endif
               
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i data-feather="users"></i>
                        <span>Customers</span>
                    </a>
                </li>

                    @if ($usr->can('offerDetailAdd') || $usr->can('offerDetailView') ||  $usr->can('offerDetailDelete') || $usr->can('offerDetailUpdate') || $usr->can('bundleofferAdd') || $usr->can('bundleofferView') ||  $usr->can('bundleofferDelete') ||  $usr->can('bundleofferUpdate'))
                <li class="sidebar-title">
                    <span>Offer</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#offerSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="offerSubmenu">
                        <i data-feather="file-text"></i>
                        <span>Offer List</span>
                        <i data-feather="chevron-down" class="ms-auto"></i>
                    </a>
                    <ul class="collapse list-unstyled {{Route::is('offer-product.create') || Route::is('offer-product.edit') || Route::is('offer-product.index') || Route::is('offer-product.show') || Route::is('bundle-offer.show') || Route::is('bundle-offer.create') || Route::is('bundle-offer.edit') || Route::is('bundle-offer.index')  ? 'show' : '' }}" id="offerSubmenu" data-bs-parent="#sidebar-menu">
                        <li><a class="nav-link {{ Route::is('bundle-offer.show') || Route::is('bundle-offer.create') || Route::is('bundle-offer.edit') || Route::is('bundle-offer.index')  ? 'active' : '' }}" href="{{route('bundle-offer.index')}}">Offer Name</a></li>
                         <li><a class="nav-link {{Route::is('offer-product.index') || Route::is('offer-product.edit') || Route::is('offer-product.create') || Route::is('offer-product.show')   ? 'active' : '' }}" href="{{route('offer-product.index')}}">Offer Product</a></li>
                    </ul>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i data-feather="bar-chart-2"></i>
                        <span>Analytics</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i data-feather="percent"></i>
                        <span>Promotions</span>
                    </a>
                </li>

                <li class="sidebar-title">
                    <span>Inventory & Purchase</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#purchaseSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="purchaseSubmenu">
                        <i data-feather="truck"></i>
                        <span>Purchase</span>
                        <i data-feather="chevron-down" class="ms-auto"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="purchaseSubmenu" data-bs-parent="#sidebar-menu">
                        <li><a class="nav-link" href="#">Purchase Return</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i data-feather="briefcase"></i>
                        <span>Supplier</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i data-feather="archive"></i>
                        <span>Stock</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i data-feather="alert-triangle"></i>
                        <span>Damage Product</span>
                    </a>
                </li>

                <li class="sidebar-title">
                    <span>Report</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reportSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="reportSubmenu">
                        <i data-feather="file-text"></i>
                        <span>Report</span>
                        <i data-feather="chevron-down" class="ms-auto"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="reportSubmenu" data-bs-parent="#sidebar-menu">
                        <li><a class="nav-link" href="#">Sales Report</a></li>
                        <li><a class="nav-link" href="#">Inventory Report</a></li>
                        <li><a class="nav-link" href="#">Customer Report</a></li>
                    </ul>
                </li>
                 @if ($usr->can('sideBarView') || $usr->can('headerAdd') || $usr->can('headerView') ||  $usr->can('headerDelete') ||  $usr->can('headerUpdate'))
                <li class="sidebar-title">
                    <span>CMS</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cmsSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="cmsSubmenu">
                        <i data-feather="file-text"></i>
                        <span>Website CMS</span>
                        <i data-feather="chevron-down" class="ms-auto"></i>
                    </a>
                    <ul class="collapse list-unstyled {{Route::is('sidebar-menu.control.index') ||  Route::is('frontend.control.index')  ? 'show' : '' }}" id="cmsSubmenu" data-bs-parent="#sidebar-menu">
                        <li><a class="nav-link {{ Route::is('frontend.control.index')  ? 'active' : '' }}" href="{{route('frontend.control.index')}}"> Header</a></li>
                         <li><a class="nav-link {{ Route::is('sidebar-menu.control.index')  ? 'active' : '' }}" href="{{route('sidebar-menu.control.index')}}">Side Bar</a></li>
                    </ul>
                </li>
                @endif
                @if ( $usr->can('userAdd') || $usr->can('userView') ||  $usr->can('userDelete') ||  $usr->can('userUpdate') || $usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate') || $usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))
                <li class="sidebar-title">
                    <span>Settings</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#accountSettingsSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="accountSettingsSubmenu">
                        <i data-feather="user"></i>
                        <span>Account</span>
                        <i data-feather="chevron-down" class="ms-auto"></i>
                    </a>
                    <ul class="collapse list-unstyled {{Route::is('users.show') || Route::is('users.index') || Route::is('users.edit') || Route::is('users.create') || Route::is('branch.index') || Route::is('branch.edit') || Route::is('branch.create') || Route::is('designation.index') || Route::is('designation.edit') || Route::is('designation.create') ? 'show' : '' }}" id="accountSettingsSubmenu" data-bs-parent="#sidebar-menu">

                          @if ($usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate'))

                        <a class="nav-link {{ Route::is('designation.index') || Route::is('designation.edit') || Route::is('designation.create') ? 'active' : '' }}" href="{{ route('designation.index') }}">Designation</a>
                   
                    @endif


                          @if ($usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))

                        <a class="nav-link {{ Route::is('branch.index') || Route::is('branch.edit') || Route::is('branch.create') ? 'active' : '' }}" href="{{ route('branch.index') }}">Branch</a>

                    @endif


                    @if ($usr->can('userAdd') || $usr->can('userView') ||  $usr->can('userDelete') ||  $usr->can('userUpdate'))

                        <a class="nav-link {{ Route::is('users.show') || Route::is('users.index') || Route::is('users.edit') || Route::is('users.create') ? 'active' : '' }}" href="{{ route('users.index') }}">User</a>

                    @endif
                       
                    </ul>
                </li>
                @endif
                   @if ($usr->can('permissionAdd') || $usr->can('permissionView') ||  $usr->can('permissionDelete') ||  $usr->can('permissionUpdate') || $usr->can('roleAdd') || $usr->can('roleView') ||  $usr->can('roleUpdate') ||  $usr->can('roleDelete') || $usr->can('panelSettingAdd') || $usr->can('panelSettingView') ||  $usr->can('panelSettingDelete') ||  $usr->can('panelSettingUpdate'))
                 <li class="nav-item">
                    <a class="nav-link" href="#generalSettingsSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="generalSettingsSubmenu">
                        <i data-feather="settings"></i>
                        <span>General</span>
                        <i data-feather="chevron-down" class="ms-auto"></i>
                    </a>
                    <ul class="collapse list-unstyled {{Route::is('roles.show') || Route::is('permissions.index') || Route::is('permissions.edit') || Route::is('permissions.create') || Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.create') || Route::is('systemInformation.index') || Route::is('systemInformation.edit') || Route::is('systemInformation.create') ? 'show' : '' }}" id="generalSettingsSubmenu" data-bs-parent="#sidebar-menu">

                            @if ($usr->can('panelSettingAdd') || $usr->can('panelSettingView') ||  $usr->can('panelSettingDelete') ||  $usr->can('panelSettingUpdate'))
                   
                        <a class="nav-link {{ Route::is('systemInformation.index') || Route::is('systemInformation.edit') || Route::is('systemInformation.create') ? 'active' : '' }}" href="{{ route('systemInformation.index') }}">Panel Settings</a>
                    
                    @endif

                    @if ($usr->can('roleAdd') || $usr->can('roleView') ||  $usr->can('roleEdit') ||  $usr->can('roleDelete'))
                   
                        <a class="nav-link {{Route::is('roles.show') || Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.create') ? 'active' : '' }}" href="{{ route('roles.index') }}">Role Management</a>
                    
                    @endif

                    @if ($usr->can('permissionAdd') || $usr->can('permissionView') ||  $usr->can('permissionDelete') ||  $usr->can('permissionUpdate'))
                   
                        <a class="nav-link {{ Route::is('permissions.index') || Route::is('permissions.edit') || Route::is('permissions.create') ? 'active' : '' }}" href="{{ route('permissions.index') }}">Permission Management</a>
                    
                    @endif

                    </ul>
                </li>
                @endif
            </ul>
        </nav>

 