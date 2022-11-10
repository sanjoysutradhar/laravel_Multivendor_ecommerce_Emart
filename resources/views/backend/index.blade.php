@extends('backend.layouts.master')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Dashboard</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">eCommerce</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('backend.layouts.notification')
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6">
                <div class="card overflowhidden">
                    <div class="body">
                        <h3>{{count(\App\Models\Category::get())}} + <i class="fas fa-sitemap float-right"></i></h3>
                        <span>Total Category</span>
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                        <div class="progress-bar" data-transitiongoal="64"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflowhidden">
                    <div class="body">
                        <h3>{{count(\App\Models\Product::get())}} +<i class="icon-basket-loaded float-right"></i></h3>
                        <span>Total Product</span>
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                        <div class="progress-bar" data-transitiongoal="64"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflowhidden">
                    <div class="body">
                        <h3>{{count(\App\Models\User::get())}} +<i class="icon-user-follow float-right"></i></h3>
                        <span>Total Customers</span>
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-purple m-b-0">
                        <div class="progress-bar" data-transitiongoal="67"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflowhidden">
                    <div class="body">
                        <h3>2,318<i class="fa fa-dollar float-right"></i></h3>
                        <span>Net Profit</span>
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-yellow m-b-0">
                        <div class="progress-bar" data-transitiongoal="89"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Recent Order</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width:60px;">#</th>
                                        <th>Order Number</th>
                                        <th>Address</th>
                                        <th>Sub Total</th>
                                        <th>Coupon</th>
                                        <th>Payment Method</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $orders=\App\Models\Order::get();
                                    @endphp
                                    @foreach($orders as $order)
                                        <tr>
                                            <td><img src="http://via.placeholder.com/60x50" alt="Product img"></td>
                                            <td>{{$order->order_number}}</td>
                                            <td>{{$order->address}}</td>
                                            <td>$ {{$order->sub_total}}</td>
                                            <td>$ {{$order->coupon}}</td>
                                            <td>{{$order->payment_method}}</td>
                                            <td>$ {{$order->total_amount}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
