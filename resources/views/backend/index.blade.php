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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width:60px;">#</th>
                                        <th>Order Number</th>
                                        <th>Address</th>
                                        <th>Sub Total</th>
                                        <th>Coupon</th>
                                        <th>condition</th>
                                        <th>Payment Method</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->order_number}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>$ {{$item->sub_total}}</td>
                                            <td>$ {{$item->coupon}}</td>
                                            <td><span class="badge badge-
                                                    @if($item->condition=='pending')
                                                    info
                                                    @elseif($item->condition=='processing')
                                                    primary
                                                    @elseif($item->condition=='complete')
                                                    success
                                                    @elseif($item->condition=='cancel')
                                                    danger
                                                    @endif
                                                    ">{{$item->condition}}</span></td>
                                            <td>{{$item->payment_method}}</td>
                                            <td>$ {{$item->total_amount}}</td>
                                            <td>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#productID" title="view"
                                                   class="float-left btn btn-sm btn-outline-info" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                                <form class="float-left ml-1" action="#" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-toggle="tooltip" title="delete" data-id=""
                                                            class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                    {{-- <a href="" data-toggle="tooltip" title="delete" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom"><i class="fas fa-trash-alt"></i></a> --}}
                                                </form>

                                            </td>
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
