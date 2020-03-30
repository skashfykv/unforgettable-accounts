<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Unforgettable | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
{!! HTML::style('bootstrap/css/bootstrap.min.css') !!}
<!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
{!! HTML::style('plugins/select2/select2.min.css') !!}
{!! HTML::style('plugins/datatables/dataTables.bootstrap.css') !!}
{!! HTML::style('plugins/select2/select2.min.css') !!}
{!! HTML::style('dist/css/AdminLTE.min.css') !!}
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
{!! HTML::style('dist/css/skins/_all-skins.min.css') !!}

<!-- iCheck -->
{!! HTML::style('plugins/iCheck/flat/blue.css') !!}
<!-- Morris chart -->
{!! HTML::style('plugins/morris/morris.css') !!}
<!-- jvectormap -->
{!! HTML::style('plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}

<!-- Date Picker -->
{!! HTML::style('plugins/datepicker/datepicker3.css') !!}
{!! HTML::style('plugins/daterangepicker/daterangepicker.css') !!}
<!-- Daterange picker -->
{{-- {!! HTML::style('plugins/daterangepicker/daterangepicker.css') !!} --}}
<!-- bootstrap wysihtml5 - text editor -->
{!! HTML::style('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="{{ asset('css/style.css?v=1.0.0') }}" rel="stylesheet">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="#" class="logo">
            <span class="logo-mini"><b>U</b>TC</span>
            <span class="logo-lg"><b><img src="{{URL::asset('img/logo.png')}}"
                                          style="height:50px;width:200px"></b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"> {{ Auth::user('name')->name }} </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <!-- <a href="#" class="btn btn-default btn-flat">Sign out</a> -->
                                    {!! HTML::link('logout','Sign out',array('class'=>'btn btn-default btn-flat')) !!}
                                </div>
                            </li>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview {{ Route::currentRouteName()=='admin' ? 'active' : '' }} ">
                    <a href="{{ URL::to('/')}}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        <span class="pull-right-container"><i class=""></i></span>
                    </a>
                </li>
                <li class="treeview {{ (Route::currentRouteName()=='brand.index' || Route::currentRouteName()=='brand.create' || Route::currentRouteName()=='brand.edit') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-briefcase"></i> <span>Brand Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteName()=='brand.create' ? 'active' : ''}}">
                            <a href="{{ route('brand.create') }}"><i class="fa fa-plus"></i>Create Brand</a>
                        </li>
                        <li class="{{ Route::currentRouteName()=='brand.index' ? 'active' : ''}}">
                            <a href="{{ route('brand.index') }}"><i class="fa fa-eye"></i>View Brands</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ (Route::currentRouteName()=='season.index' || Route::currentRouteName()=='season.create' || Route::currentRouteName()=='season.edit') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-cloud"></i> <span>Season Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteName()=='season.create' ? 'active' : ''}}">
                            <a href="{{ route('season.create') }}"><i class="fa fa-plus"></i>Create Season</a>
                        </li>
                        <li class="{{ Route::currentRouteName()=='season.index' ? 'active' : ''}}">
                            <a href="{{ route('season.index') }}"><i class="fa fa-eye"></i>View Seasons</a>
                        </li>
                    </ul>
                </li>
                <?php
                $book_id = @$book_id;
                $id = @$id;
                ?>
                {{--<li class="treeview @if (Request::is('create-booking') || Request::is('view-booking/'.$book_id) || Request::is('view-booking-season') || Request::is('update-booking/'.$id) ) active @endif">--}}
                    {{--<a href="#"><i class="fa fa-user"></i><span>Booking</span><span class="pull-right-container"><i--}}
                                    {{--class="fa fa-angle-left pull-right"></i></span></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li class="{{Request::is('create-booking') ? 'active' : ''}}"><a--}}
                                    {{--href="{{ route('create-booking')}}"><i class="fa fa-plus"></i>Create Booking</a>--}}
                        {{--</li>--}}
                        {{--<li class="{{Request::is('view-booking-season') ? 'active' : ''}}"><a--}}
                                    {{--href="{{ route('view-booking-season')}}"><i class="fa fa-eye"></i>View Booking--}}
                                {{--Season</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <li class="treeview {{ (Route::currentRouteName()=='user.index' || Route::currentRouteName()=='user.create' || Route::currentRouteName()=='user.edit') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-user"></i> <span>User Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteName()=='user.create' ? 'active' : ''}}">
                            <a href="{{ route('user.create') }}"><i class="fa fa-plus"></i>Create User</a>
                        </li>
                        <li class="{{ Route::currentRouteName()=='user.index' ? 'active' : ''}}">
                            <a href="{{ route('user.index') }}"><i class="fa fa-eye"></i>View Users</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ (Route::currentRouteName()=='expense-category.index' || Route::currentRouteName()=='expense-category.create' || Route::currentRouteName()=='expense-category.edit') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-cloud"></i> <span>Expense Category</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteName()=='expense-category.create' ? 'active' : ''}}">
                            <a href="{{ route('expense-category.create') }}"><i class="fa fa-plus"></i>Create Expense Category</a>
                        </li>
                        <li class="{{ Route::currentRouteName()=='expense-category.index' ? 'active' : ''}}">
                            <a href="{{ route('expense-category.index') }}"><i class="fa fa-eye"></i>View Expense Category</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview @if (Request::is('creat-airline') || Request::is('view-airline') || Request::is('creat-payment') || Request::is('view-payment')) active @endif">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Setting</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is('creat-airline') ? 'active' : ''}}"><a
                                    href="{{ route('creat-airline')}}"><i class="fa fa-plus"></i>Create Airline</a></li>
                        <li class="{{Request::is('view-airline') ? 'active' : ''}}"><a
                                    href="{{ route('view-airline')}}"><i class="fa fa-eye"></i>View Airline</a></li>
                        <li class="{{Request::is('creat-payment') ? 'active' : ''}}"><a
                                    href="{{ route('creat-payment')}}"><i class="fa fa-plus"></i>Create Payment
                                Method</a></li>
                        <li class="{{Request::is('view-payment') ? 'active' : ''}}"><a
                                    href="{{ route('view-payment')}}"><i class="fa fa-eye"></i>View Payment Method</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>
@yield('content')