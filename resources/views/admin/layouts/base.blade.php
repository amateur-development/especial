
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('admin/img/favicon.png')}}">
    <title>Home</title>
    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
    <link href="{{asset('admin/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('common/layui/css/layui.css')}}" rel="stylesheet">
    @yield('styles')
</head>



<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
    <a class="navbar-brand" href="#"></a>
    <ul class="nav navbar-nav hidden-md-down">
        <li class="nav-item">
            <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
        </li>

        <li class="nav-item px-1">
            <a class="nav-link" href="#">Dashboard</a>
        </li>
        @foreach($menuNodes->where('parent_id',0)->where('is_show',1)->sortBy('sort') as $node)
            @if(!$adminNodes->contains($node->id))
                @continue
            @endif
            <li class="nav-item px-1 @if($menuFirstNode && ($menuFirstNode['id'] == $node['id'])) active @endif">
                <a class="nav-link" href="{{try_route($node['route'])}}" data-id="{{$node['id']}}">{{$node['title']}}</a>
            </li>
        @endforeach
        <li class="nav-item px-1">
            <a class="nav-link" href="#">Settings</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item hidden-md-down">
            <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
        </li>
        <li class="nav-item hidden-md-down">
            <a class="nav-link" href="#"><i class="icon-list"></i></a>
        </li>
        <li class="nav-item hidden-md-down">
            <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('admin/img/avatars/6.jpg')}}" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="hidden-md-down">admin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>

                <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>

                <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                </div>

                <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-default">42</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
                <div class="divider"></div>
                <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-lock"></i> Logout</a>
            </div>
        </li>
        <li class="nav-item hidden-md-down">
            <a class="nav-link navbar-toggler aside-menu-toggler" href="#">☰</a>
        </li>

    </ul>
</header>

<div class="app-body">
    @include('admin.layouts.right_sidebar')

    <!-- Main content -->
    @yield('content')

    @include('admin.layouts.sidebar_left')

</div>

<footer class="app-footer">
    Copyright &copy; 2017.Company name All rights reserved.
    </span>
</footer>

<!-- Bootstrap and necessary plugins -->
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="{{asset('admin/assets/js/libs/tether.min.js')}}"></script>
<script src="{{asset('admin/assets/js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/assets/js/libs/pace.min.js')}}"></script>
<!-- Plugins and scripts required by all views -->
<script src="{{asset('admin/assets/js/libs/Chart.min.js')}}"></script>
<!-- GenesisUI main scripts -->
<script src="{{asset('admin/js/app.js')}}"></script>
<script src="{{asset('common/layui/layui.js')}}"></script>
<script src="{{asset('admin/common.js')}}"></script>
@yield('scripts')
</body>
</html>