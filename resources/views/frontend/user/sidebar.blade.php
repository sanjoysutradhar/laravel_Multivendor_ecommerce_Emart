<ul>
    <li class="{{\Request::is('user/dashboard')? 'active' : ''}}"><a href="{{route('user.dashboard')}}">Dashboard</a></li>
    <li class="{{\Request::is('user/order')? 'active' : ''}}"><a href="{{route('user.order')}}">Orders</a></li>

    <li class="{{\Request::is('user/address')? 'active' : ''}}"><a href="{{route('user.address')}}">Addresses</a></li>
    <li class="{{\Request::is('user/account-details')? 'active' : ''}}"><a href="{{route('user.account')}}">Account Details</a></li>
    <li ><a href="{{route('logout.submit')}}">Logout</a></li>
</ul>
