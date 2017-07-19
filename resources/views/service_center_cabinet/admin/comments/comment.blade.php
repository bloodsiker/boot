@extends('service_center_cabinet.layouts.master')


@section('content')

    <div ng-controller="" ng-cloak>
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('cabinet.admin.user.list') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li class="active">Комментарии</li>
            </ol>
        </section>

        <section class="content" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-comments" aria-hidden="true"></i>  Комментарий #{{ $comment->id }}</h3>
                            <span class="label pull-right bg-green" style="font-size: 15px;">{{ $comment->status == 1 ? 'Опубликован' : 'Не опубликован' }}</span>
                        </div>
                        <div class="box-body">

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-3">
                                            @if($comment->user_id != '' || !empty($comment->user_id))
                                                <div class="review-block-name bg-gray text-center" style="margin-bottom: 10px">Зарегистрирован</div>
                                                <img src="{{ asset($comment->avatar) }}" class="comment-avatar">
                                            @else
                                                <div class="review-block-name bg-gray text-center" style="margin-bottom: 10px">Не зарегистрирован</div>
                                                <img src="{{ asset('site/img/logo_user_default.png') }}" class="comment-avatar">
                                            @endif
                                            <div class="review-block-name"><b>Имя:</b> {{ $comment->user_name }}</div>
                                            <div class="review-block-name"><b>Девайс:</b> {{ $comment->device }}</div>
                                            <div class="review-block-name"><b>Услуга:</b> {{ $comment->service }}</div>
                                            <div class="review-block-name"><b>Номер услуги:</b> {{ $comment->service_number }}</div>
                                            <div class="review-block-name"><b>Дата:</b> {{ $comment->created_at }}</div>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-9">
                                            <div class="review-block-title">Комментарий</div>
                                            <div class="review-block-description">{{ $comment->text }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4 text-center">
                                            <h1 class="rating-num">{{ $comment->r_total_rating }}</h1>
                                            <div class="rating">
                                                <span class="glyphicon glyphicon-star{{ $comment->r_total_rating < 1 ? '-empty' : '' }}"></span>
                                                <span class="glyphicon glyphicon-star{{ $comment->r_total_rating < 2 ? '-empty' : '' }}"></span>
                                                <span class="glyphicon glyphicon-star{{ $comment->r_total_rating < 3 ? '-empty' : '' }}"></span>
                                                <span class="glyphicon glyphicon-star{{ $comment->r_total_rating < 4 ? '-empty' : '' }}"></span>
                                                <span class="glyphicon glyphicon-star{{ $comment->r_total_rating < 5 ? '-empty' : '' }}"></span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                            <div class="row rating-desc">
                                                <div class="col-xs-5 col-md-5 text-left">
                                                    <span>Качество работ</span>
                                                </div>
                                                <div class="col-xs-2 col-md-2 text-right">
                                                    <span class="glyphicon glyphicon-star"></span>{{ $comment->r_quality_of_work }}
                                                </div>
                                                <div class="col-xs-5 col-md-5">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                                             aria-valuemin="0" aria-valuemax="100" style="width: {{ \App\Models\Comments::percentProgress($comment->r_quality_of_work) }}%">
                                                            <span class="sr-only-rating">{{ \App\Models\Comments::percentProgress($comment->r_quality_of_work) }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 5 -->
                                                <div class="col-xs-5 col-md-5 text-left">
                                                    <span>Соблюдение сроков</span>
                                                </div>
                                                <div class="col-xs-2 col-md-2 text-right">
                                                    <span class="glyphicon glyphicon-star"></span>{{ $comment->r_deadlines }}
                                                </div>
                                                <div class="col-xs-5 col-md-5">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                                             aria-valuemin="0" aria-valuemax="100" style="width: {{ \App\Models\Comments::percentProgress($comment->r_deadlines) }}%">
                                                            <span class="sr-only-rating">{{ \App\Models\Comments::percentProgress($comment->r_deadlines) }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 4 -->
                                                <div class="col-xs-5 col-md-5 text-left">
                                                    <span>Соблюдение стоимости</span>
                                                </div>
                                                <div class="col-xs-2 col-md-2 text-right">
                                                    <span class="glyphicon glyphicon-star"></span>{{ $comment->r_compliance_cost }}
                                                </div>
                                                <div class="col-xs-5 col-md-5">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                                             aria-valuemin="0" aria-valuemax="100" style="width: {{ \App\Models\Comments::percentProgress($comment->r_compliance_cost) }}%">
                                                            <span class="sr-only-rating">{{ \App\Models\Comments::percentProgress($comment->r_compliance_cost) }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 3 -->
                                                <div class="col-xs-5 col-md-5 text-left">
                                                    <span>Цена/качество</span>
                                                </div>
                                                <div class="col-xs-2 col-md-2 text-right">
                                                    <span class="glyphicon glyphicon-star"></span>{{ $comment->r_price_quality }}
                                                </div>
                                                <div class="col-xs-5 col-md-5">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                                             aria-valuemin="0" aria-valuemax="100" style="width: {{ \App\Models\Comments::percentProgress($comment->r_price_quality) }}%">
                                                            <span class="sr-only-rating">{{ \App\Models\Comments::percentProgress($comment->r_price_quality) }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 2 -->
                                                <div class="col-xs-5 col-md-5 text-left">
                                                    <span>Обслуживание</span>
                                                </div>
                                                <div class="col-xs-2 col-md-2 text-right">
                                                    <span class="glyphicon glyphicon-star"></span>{{ $comment->r_service }}
                                                </div>
                                                <div class="col-xs-5 col-md-5">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                                             aria-valuemin="0" aria-valuemax="100" style="width: {{ \App\Models\Comments::percentProgress($comment->r_service) }}%">
                                                            <span class="sr-only-rating">{{ \App\Models\Comments::percentProgress($comment->r_service) }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 1 -->
                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <form action="{{ route('cabinet.admin.comment.published', ['id' => $comment->id]) }}" method="POST" class="pull-right">
                                    {{ csrf_field() }}
                                    @if($comment->status == 0)
                                        <input type="hidden" name="status" value="1">
                                        <div class="form-group pull-left">
                                            <select class="form-control" name="sc_notification">
                                                <option value="0">Не оповещать сервисный центр</option>
                                                <option value="1">Оповестить сервисный центр</option>
                                            </select>
                                        </div>
                                        <div class="form-group pull-right">
                                            <button class="btn btn-warning form-control">Опубликовать</button>
                                        </div>
                                    @elseif($comment->status == 1)
                                        <input type="hidden" name="status" value="0">
                                        <button class="btn btn-warning">Скрыть из публикации</button>
                                    @endif
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
