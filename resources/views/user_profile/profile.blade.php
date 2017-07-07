@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')


    <div class="container user_profile">

        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked nav-email shadow mb-20">
                    <li class="active">
                        <a href="{{ route('user.dashboard') }}"><i class="fa fa-inbox"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-certificate"></i> Избранные</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-file-text-o"></i> Заявки <span class="label label-info pull-right inbox-notification">35</span>
                        </a>
                    </li>
                </ul><!-- /.nav -->

                <h5 class="nav-email-subtitle">More</h5>
                <ul class="nav nav-pills nav-stacked nav-email mb-20 rounded shadow">
                    <li>
                        <a href=""><i class="fa fa-user"></i> Профиль</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cogs"></i> Настройки </a>
                    </li>
                </ul><!-- /.nav -->
            </div>
            <div class="col-sm-9">

                <!--  statitics -->
                <div class="row hidden">
                    <div class="col-lg-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <i class="fa fa-envelope-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <p class="announcement-heading">1</p>
                                        <!--	<p class="announcement-text">Users</p> -->
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer announcement-bottom">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            Сообщения
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <i class="fa fa-comment-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <p class="announcement-heading">12</p>
                                        <!-- <p class="announcement-text"> Items</p> -->
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer announcement-bottom">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            Избранные
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <i class="fa fa-bell-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <p class="announcement-heading">18</p>
                                        <p class="announcement-text">Crawl</p>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer announcement-bottom">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            Requests
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <p class="announcement-heading">56</p>
                                        <p class="announcement-text"> Orders!</p>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer announcement-bottom">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            Complete
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div><!-- /.row -->
                <!--  statitics -->


                <div class="panel rounded shadow panel-teal">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title">Последние сообщения</h3>
                        </div>
                        <div class="pull-right">
                            <form action="#" class="form-horizontal mr-5 mt-3">
                                <div class="form-group no-margin no-padding has-feedback">

                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-sub-heading inner-all">
                        <div class="pull-left">
                            <ul class="list-inline no-margin">
                                <li>
                                    <div class="ckbox ckbox-theme">

                                        <label for="checkbox-group"></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm tooltips" type="button" data-toggle="tooltip" data-container="body" title="" data-original-title="Archive"><i class="fa fa-list" aria-hidden="true"></i></button>
                                        <button class="btn btn-default btn-sm tooltips" type="button" data-toggle="tooltip" data-container="body" title="" data-original-title="Report Spam"><i class="fa fa-th" aria-hidden="true"></i></button>
                                        <button class="btn btn-default btn-sm tooltips" type="button" data-toggle="tooltip" data-container="body" title="" data-original-title="Delete"> <i class="fa fa-th-large" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li class="hidden-xs">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm">Sort by</button>
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#"><i class="fa fa-edit"></i> Last login</a></li>
                                            <li><a href="#"><i class="fa fa-ban"></i> Age</a></li>
                                            <!-- <li class="divider"></li> -->
                                            <li><a href="#"><i class="fa fa-trash-o"></i> Height</a></li>
                                            <li><a href="#"><i class="fa fa-trash-o"></i> Photo</a></li>
                                            <li><a href="#"><i class="fa fa-trash-o"></i> Created date</a></li>
                                            <li><a href="#"><i class="fa fa-trash-o"></i> Horoscope</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="hidden-xs hidden">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li class="dropdown-header">Display settings :</li>
                                            <li class="active"><a href="#"><i class="fa fa-list" aria-hidden="true"></i> Single column view</a></li>
                                            <li><a href="#"><i class="fa fa-th" aria-hidden="true"></i> Photo view</a></li>
                                            <li><a href="#"><i class="fa fa-th-large" aria-hidden="true"></i> Two columns view</a></li>
                                            <!-- <li class="dropdown-header">Configure inbox</li> -->
                                            <li><a href="#">Details view</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <ul class="list-inline no-margin">
                                <li class="hidden-xs"><span class="text-muted">Showing 1-50 of 2,051 messages</span></li>
                                <li>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-default"><i class="fa fa-angle-left"></i></a>
                                        <a href="#" class="btn btn-sm btn-default"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.panel-sub-heading -->
                    <div class="panel-body no-padding">


                        <section class="comment-list">
                            <!-- First Comment -->
                            <article class="row">
                                <div class="col-md-2 col-sm-2 hidden-xs">
                                    <figure class="thumbnail">
                                        <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                        <figcaption class="text-center">username</figcaption>
                                    </figure>
                                </div>
                                <div class="col-md-10 col-sm-10">
                                    <div class="panel panel-default arrow left">
                                        <div class="panel-body">
                                            <header class="text-left">
                                                <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                            </header>
                                            <div class="comment-post">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                </p>
                                            </div>
                                            <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </section>

                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
            </div>
        </div>
    </div>

@endsection