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
                            <a href="{{ route('user.request.find') }}" class="btn btn-warning">Найти заявку</a>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body no-padding"  style="margin-top: 15px">

                        <section class="content">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="table-container">

                                            @include('user_profile.includes.message-block')

                                            <table class="table table-filter">
                                                <tbody>
                                                @if(count($list_request))
                                                    @foreach($list_request as $request)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('user.request', ['r_id' => $request->r_id]) }}" class="r_id">#{{ $request->r_id }}</a>
                                                            </td>
                                                            <td>
                                                                <div class="media">
                                                                    <div class="media-body">
                                                                        <span class="media-meta pull-right">{{ $request->created_at }}</span>
                                                                        <h4 class="title">
                                                                            <a href="{{ route('sc', ['id' => $request->service_center['id']]) }}">{{ $request->service_center['service_name'] }}</a>
                                                                            <span class="pull-right {{ \App\Models\FormRequest::getColorStatus($request->status_id) }}">{{ $request->status['status'] }}</span>
                                                                        </h4>
                                                                        <p class="summary">{{ $request->services }}</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-center"><h2>Вы еще не создавали заявок</h2></td>
                                                    </tr>
                                                @endif
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