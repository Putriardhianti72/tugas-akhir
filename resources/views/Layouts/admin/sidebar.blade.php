<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{asset('admin')}}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                    @if (admin_auth()->check())
                                        <span>{{ admin_auth()->user()->get('nama') }}</span>
                                        <span class="user-level">Administrator</span>
									<span class="caret"></span>
                                    @endif
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a data-action="logout" href="#">
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">

                {{-- <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                    <h4 class="text-section">Components</h4>
                </li> --}}
                <li class="nav-item {{\Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard')  }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{\Route::currentRouteName() == 'admin.categories.index' || \Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}" >
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Catalogue Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{\Route::currentRouteName() == 'admin.categories.index' || \Route::currentRouteName() == 'admin.products.index' ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{\Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}">
                                <a href="{{ route('admin.categories.index')  }}">
                                    <span class="sub-item">Kategori</span>
                                </a>
                            </li>
                            <li class="{{\Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}">
                                <a href="{{ route('admin.products.index')  }}">
                                    <span class="sub-item">Produk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{\Route::currentRouteName() == 'admin.orders.index' || \Route::currentRouteName() == 'admin.retail-orders.index' ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-desktop"></i>
                        <p>Sales</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse{{\Route::currentRouteName() == 'admin.orders.index' || \Route::currentRouteName() == 'admin.retail-orders.index' ? 'active' : '' }} " id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li  class="{{\Route::currentRouteName() == 'admin.orders.index' ? 'active' : '' }}">
                                <a href="{{route('admin.orders.index')}}">
                                    <span class="sub-item">Order Member</span>
                                </a>
                            </li>
                            <li  class="{{\Route::currentRouteName() == 'admin.retail-orders.index' ? 'active' : '' }}">
                                <a href="{{route('admin.retail-orders.index')}}">
                                    <span class="sub-item">Order Retail</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{\Route::currentRouteName() == 'admin.retail-rewards.index' ? 'active' : '' }}">
                    <a href="{{route('admin.retail-rewards.index')}}">
                        <i class="fas fa-file-invoice-dollar- fa-dollar-sign"></i>
                        <p>Reward</p>
                    </a>
                </li>
                <li class="nav-item {{\Route::currentRouteName() == 'admin.sales-recap.index' || \Route::currentRouteName() == 'admin.sales-recap-member-sales.index' ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#sidebarSalesRecapLayouts">
                        <i class="fas fa-chart-bar"></i>
                        <p>Sales Recap</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse{{\Route::currentRouteName() == 'admin.sales-recap.index' || \Route::currentRouteName() == 'admin.sales-recap-member-sales.index' || \Route::currentRouteName() == 'admin.sales-recap-most-sales.index' ? 'active' : '' }} " id="sidebarSalesRecapLayouts">
                        <ul class="nav nav-collapse">
                            <li  class="{{\Route::currentRouteName() == 'admin.sales-recap.index' ? 'active' : '' }}">
                                <a href="{{route('admin.sales-recap.index')}}">
                                    <span class="sub-item">Rekap Penjualan</span>
                                </a>
                            </li>
                            <li  class="{{\Route::currentRouteName() == 'admin.sales-recap-most-sales.index' ? 'active' : '' }}">
                                <a href="{{route('admin.sales-recap-most-sales.index')}}">
                                    <span class="sub-item">Penjualan Terlaris</span>
                                </a>
                            </li>
                            <li  class="{{\Route::currentRouteName() == 'admin.sales-recap-member-sales.index' ? 'active' : '' }}">
                                <a href="{{route('admin.sales-recap-member-sales.index')}}">
                                    <span class="sub-item">Penjualan Member</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
           {{--      <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Forms</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Basic Form</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                 <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Rekap Penjualan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Tables</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/jqvmap.html">
                                    <span class="sub-item">JQVMap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mx-4 mt-2">
                    <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
