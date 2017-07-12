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
                            <h3 class="panel-title">Поиск заявки</h3>
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
                                            <p>В случае если вы оставляли заявку сервисному центру и не были авторизированы, то можете найти эту заявку по номеру и подвязать под свой аккаунт</p>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="table-container">

                                            <div class="well">
                                                <form action="{{ route('user.request.find') }}" method="GET">
                                                    <div class="input-group input-search-rid">
                                                        <input class="btn btn-lg" name="r_id" id="r_id" type="text" value="{{ Request::old('r_id') }}" placeholder="Номер заявки">
                                                        <button class="btn btn-info btn-lg find_rid" type="submit">Поиск</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <table class="table table-filter">
                                                <tbody>
                                                @if(isset($user_request) && $result == 1)
                                                    <tr>
                                                        <td>
                                                            @if(empty($user_request->user_id))
                                                                <a href="{{ route('user.request', ['r_id' => $user_request->r_id]) }}" class="r_id">#{{ $user_request->r_id }}</a>
                                                            @else
                                                                <span class="r_id">#{{ $user_request->r_id }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <span class="media-meta pull-right">{{ $user_request->created_at }}</span>
                                                                    <h4 class="title">
                                                                        <a href="{{ route('sc', ['id' => $user_request->service_center['id']]) }}">{{ $user_request->service_center['service_name'] }}</a>
                                                                        <span class="pull-right {{ \App\Models\FormRequest::getColorStatus($user_request->status_id) }}">{{ $user_request->status['status'] }}</span>
                                                                    </h4>
                                                                    <p class="summary">{{ $user_request->services }}</p>
                                                                    @if(empty($user_request->user_id))
                                                                        <form action="{{ route('user.request.bind') }}" method="post">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="request_id" value="{{ $user_request->id }}">
                                                                            <button class="btn btn-xs btn-primary pull-right">Привязать</button>
                                                                        </form>
                                                                    @else
                                                                        <span class="btn btn-xs btn-primary pull-right">Эта заявка принадлежит другому пользователю</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @elseif($result == 2)
                                                    <tr>
                                                        <td class="text-center"><h2>Заявки с таким номером не найдено</h2></td>
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