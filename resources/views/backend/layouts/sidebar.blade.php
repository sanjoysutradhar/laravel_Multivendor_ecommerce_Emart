<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{Helper::userDefaultImage()}}" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="user-name"><strong>{{auth('admin')->user()->full_name}}</strong></a>
            </div>
        </div>

        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="admin">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <li class="active"><a href="{{route('admin')}}"><i class="icon-grid"></i><span>Dashboard</span></a></li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-picture"></i><span>Banner Management</span> </a>
                            <ul>
                                <li><a href="{{route('banner.index')}}">All Banners</a></li>
                                <li><a href="{{route('banner.create')}}">Add Banner</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fas fa-sitemap"></i><span>category Management</span> </a>
                            <ul>
                                <li><a href="{{route('category.index')}}">All Categories</a></li>
                                <li><a href="{{route('category.create')}}">Add Category</a></li>
                            </ul>
                        </li>
                        {{-- brand section --}}
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-handbag"></i><span>Brand Management</span> </a>
                            <ul>
                                <li><a href="{{route('brand.index')}}">All Brands</a></li>
                                <li><a href="{{route('brand.create')}}">Add Brand</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-briefcase"></i><span>Products Management</span> </a>
                            <ul>
                                <li><a href="{{route('product.index')}}">All Products</a></li>
                                <li><a href="{{route('product.create')}}">Add Products</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-people"></i><span>User Management</span> </a>
                            <ul>
                                <li><a href="{{route('user.index')}}">All Users</a></li>
                                <li><a href="{{route('user.create')}}">Add Users</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('order.index')}}"><i class="icon-layers"></i>Order Management</a></li>

                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fas fa-truck"></i><span>Shipping Management</span> </a>
                            <ul>
                                <li><a href="{{route('shipping.index')}}">All Shipping</a></li>
                                <li><a href="{{route('shipping.create')}}">Add Shipping</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fas fa-money-bill-alt"></i><span>Currency Management</span> </a>
                            <ul>
                                <li><a href="{{route('currency.index')}}">All Currencies</a></li>
                                <li><a href="{{route('currency.create')}}">Add Currency</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fas fa-sitemap"></i><span>Post Category</span> </a>
                            <ul>
                                <li><a href="departments.html">All Departments</a></li>
                                <li><a href="add-departments.html">Add Departments</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-tag"></i><span>Post Tag</span> </a>
                            <ul>
                                <li><a href="departments.html">All Departments</a></li>
                                <li><a href="add-departments.html">Add Departments</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fas fa-newspaper"></i><span>Post Management</span> </a>
                            <ul>
                                <li><a href="departments.html">All Departments</a></li>
                                <li><a href="add-departments.html">Add Departments</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-star"></i><span>Review Management</span> </a>
                            <ul>
                                <li><a href="departments.html">All Departments</a></li>
                                <li><a href="add-departments.html">Add Departments</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-gift"></i><span>Coupon Management</span> </a>
                            <ul>
                                <li><a href="{{route('coupon.index')}}">All Coupons</a></li>
                                <li><a href="{{route('coupon.create')}}">Add Coupons</a></li>

                            </ul>
                        </li>

                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-bubbles"></i><span>Comments Management</span> </a>
                            <ul>
                                <li><a href="departments.html">All Departments</a></li>
                                <li><a href="add-departments.html">Add Departments</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('setting')}}"><i class="icon-settings"></i>Settings</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
