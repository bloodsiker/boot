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
                            <h3 class="panel-title">Заявка #{{ $user_request->r_id }}</h3>
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
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h4><a href="{{ route('sc', ['id' => $service_center->id]) }}">{{ $service_center->service_name }}</a></h4>
                                                <span><strong>Адрес:</strong> {{ $service_center->address }}</span>
                                                @if(!empty($service_center->number_h_add))
                                                    <br><span>{{ $service_center->number_h_add }}</span>
                                                @endif
                                                <br>
                                                @if(count($service_center->service_phones))
                                                    <span><strong>Телефон:</strong></span>
                                                    <ul class="user_request_ul">
                                                        @foreach($service_center->service_phones as $phone)
                                                            <li>{{ $phone->phone }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                                @if(count($service_center->service_emails))
                                                    <span><strong>Email:</strong></span>
                                                    <ul class="user_request_ul">
                                                        @foreach($service_center->service_emails as $email)
                                                            <li>{{ $email->email }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <br>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <img src="{{ $service_center->logo }}" class="img-responsive" alt="">
                                            </div>
                                            <br>

                                            <div class="col-md-12" style="margin-top: 20px">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"><strong>Информация о заявке</strong></h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-condensed">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Статус</td>
                                                                    <td class="text-right">
                                                                        <span class="{{ \App\Models\FormRequest::getColorStatus($user_request->status_id) }}">{{ $user_request->status['status'] }}</span>
                                                                    </td>
                                                                </tr>
                                                                @if($user_request->status_id == 3)
                                                                <tr>
                                                                    <td>Причина отказа:</td>
                                                                    <td class="text-right">{{ !empty($user_request->cancel_comment) ? $user_request->cancel_comment : 'Причина не указана'}}</td>
                                                                </tr>
                                                                @endif
                                                                @if(!empty($user_request->deadline))
                                                                    <tr>
                                                                        <td>Приблизительное дата завершение работы: </td>
                                                                        <td class="text-right">{{ $user_request->deadline }}</td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td>Производитель устройства:</td>
                                                                    <td class="text-right">{{ $user_request->manufacturer }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Услуга:</td>
                                                                    <td class="text-right">{{ $user_request->services }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Стоимость работы (ориентировочно):</td>
                                                                    <td class="text-right">{{ $user_request->cost_of_work_min }} - {{ $user_request->cost_of_work_max }}  {{ ($user_request->exit_master == 1) ? '(Выезд мастера + 50грн)' : null }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Окончательная стоимость работы: <br><span class="status_desc">указывается вами на этапе (Выполнена, ожитает закрытия)</span></td>
                                                                    <td class="text-right">{{ $user_request->cost_of_work_end }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Способ оплаты:</td>
                                                                    <td class="text-right">{{ $user_request->payment_method }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Выезд мастера:</td>
                                                                    <td class="text-right">{{ $user_request->exit_master == 1 ? 'Да' : 'Нет' }}</td>
                                                                </tr>
                                                                @if($user_request->exit_master == 1)
                                                                    <tr>
                                                                        <td>Адрес клиента:</td>
                                                                        <td class="text-right">{{ $user_request->client_address }}</td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-sm-12 message_section">
                                    <div class="row">
                                        <div class="new_message_head">
                                            <div class="pull-left">
                                                Общение с сервисным центром
                                            </div>
                                        </div><!--new_message_head-->

                                        <div class="chat_area">
                                            <ul class="list-unstyled">
                                                @foreach($user_request->messages as $message)
                                                    @if(!empty($message->user_name))
                                                        <li class="left clearfix">
                                                             <span class="chat-img1 pull-left">
                                                             <img src="{{ $message->avatar }}" alt="User Avatar" class="img-circle">
                                                             </span>
                                                            <div class="chat-body1 clearfix">
                                                                <div class="chat_time clearfix">
                                                                    <span class="pull-left"><strong>{{ $message->user_name }}</strong></span>
                                                                    <span class="pull-right time_mess">{{ $message->created_at }}</span>
                                                                </div>
                                                                <p>{{ $message->message }}</p>

                                                            </div>
                                                        </li>

                                                    @else

                                                        <li class="left clearfix admin_chat">
                                                     <span class="chat-img1 pull-right">
                                                     <img src="{{ $message->logo }}" alt="User Avatar" class="img-circle">
                                                     </span>
                                                            <div class="chat-body1 clearfix">
                                                                <div class="chat_time clearfix">
                                                                    <span class="pull-right"><strong>{{ $message->service_name }}</strong></span>
                                                                    <span class="pull-left time_mess">{{ $message->created_at }}</span>
                                                                </div>
                                                                <p>{{ $message->message }}</p>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div><!--chat_area-->
                                        <div class="message_write">
                                            <form action="{{ route('user.request.send_message', ['r_id' => $user_request->r_id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="request_id" value="{{ $user_request->id }}">
                                                <textarea class="form-control" name="message" id="send-message"
                                                          placeholder="Сообщение"></textarea>
                                                <div class="clearfix"></div>
                                                <div class="chat_bottom">
                                                    <button class="pull-right btn btn-success">
                                                        Отправить</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!--message_section-->
                            </div>
                        </section>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->

            </div>
        </div>
    </div>

@endsection