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
                    <div class="panel-heading panel-heading-black">
                        <div class="pull-left">
                            <h3 class="panel-title">Избранные сервисные центры</h3>
                        </div>
                        <div class="pull-right">
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
                                                    @foreach($favorite_centers->favorite_service as $favorite)
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <a href="javascript:;" class="star star-checked">
                                                                    <i class="glyphicon glyphicon-star"></i>
                                                                </a>
                                                            </td>
                                                            <td width="150px">
                                                                <img src="{{ $favorite->logo }}" alt="">
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('sc', ['id' => $favorite->id]) }}" class="">{{ $favorite->service_name }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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