@extends('site.layouts.master')

@section('title', $data_seo[0]->title_name )

@section('description', $data_seo[0]->description)

@section('keywords', $data_seo[0]->keywords)

@section('controller', 'SignCtrl')


@section('content')


    <div class="container user_profile">

        <div class="row">
            <div class="col-sm-3">

                @include('user_profile.includes.sidebar')

            </div>
            <div class="col-sm-9">

                <div class="panel rounded shadow panel-teal">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title">Заявки</h3>
                        </div>
                        <div class="pull-right">
                            <form action="#" class="form-horizontal mr-5 mt-3">
                                <div class="form-group no-margin no-padding has-feedback">

                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body no-padding"  style="margin-top: 15px">

                        <section class="content">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="table-container">
                                            <table class="table table-filter">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;" class="star">
                                                            <i class="glyphicon glyphicon-star"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                                <h4 class="title">
                                                                    Lorem Impsum
                                                                    <span class="pull-right pagado">(Pagado)</span>
                                                                </h4>
                                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->

            </div>
        </div>
    </div>

@endsection