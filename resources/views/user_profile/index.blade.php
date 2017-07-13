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
                    <div class="panel-body no-padding">


                        <section class="comment-list">
                            <!-- First Comment -->
                            @foreach($last_messages as $message)
                                <article class="row">
                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive" src="{{ $message->logo }}" />
                                        </figure>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i> {{ $message->service_name }}</div>
                                                    <time class="comment-date"><i class="fa fa-clock-o"></i><span class="time_mess"> {{ $message->created_at }}</span></time>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        {{ $message->message }}
                                                    </p>
                                                </div>
                                                <p class="text-right"><a href="{{ route('user.request', ['r_id' => $message->r_id]) }}#send-message" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Ответить</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </section>

                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
            </div>
        </div>
    </div>

@endsection