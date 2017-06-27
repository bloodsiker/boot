@extends('site.emails.layouts.master')

@section('content')

    <h3>Выша заявка #{{ $user_request->r_id }} на услугу &laquo;{{ $user_request->services  }}&raquo; перешла в статус &laquo;{{ $user_request->status }}&raquo;</h3>
    @if($user_request->status == 'Отклонена')
        <h3>Комментарий от сервисного центра:</h3>
        <table class="content" width="100%" cellpadding="5" cellspacing="0" style="background: #f17c70; color: #fff">
            <tr>
                <td>
                    <span>{{ !empty($user_request->cancel_comment) ? $user_request->cancel_comment : 'Причина не указана!' }}</span>
                </td>
            </tr>
        </table>
    @endif

    @if(!empty($user_request->deadline))
        <h3>Приблизительное дата завершение работы : {{ $user_request->deadline }}</h3>
    @endif
    <hr>
    <h4>Информация о заявке:</h4>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
            <td><strong>Производитель устройства:</strong></td>
            <td>{{ $user_request->manufacturer }}</td>
        </tr>
        <tr>
            <td><strong>Услуга:</strong></td>
            <td>{{ $user_request->services }}</td>
        </tr>
        <tr>
            <td><strong>Стоимость работы (ориентировочно):</strong></td>
            <td>{{ $user_request->cost_of_work }}</td>
        </tr>
        <tr>
            <td><strong>Описание задачи:</strong></td>
            <td>{{ $user_request->task_description }}</td>
        </tr>
        <tr>
            <td><strong>Способ оплаты:</strong></td>
            <td>{{ $user_request->payment_method }}</td>
        </tr>
        <tr>
            <td><strong>Выезд мастера:</strong></td>
            <td>{{ $user_request->exit_master }}</td>
        </tr>
    </table>
    <br>
    <hr>
    <h4>Данные сервисного цента:</h4>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
            <td><strong>Сервисный центр:</strong></td>
            <td>{{ $service_center->service_name }}</td>
        </tr>
        <tr>
            <td><strong>Адрес:</strong></td>
            <td>{{ $service_center->address . ',' .  $service_center->number_h_add }}</td>
        </tr>
        <tr>
            <td><strong>Телефон(ы):</strong></td>
            <td>
                @if(count($service_center->service_phones))
                    <ul>
                        @foreach($service_center->service_phones as $phone)
                            <li>{{ $phone->phone }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Телефон не указан</p>
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>E-mail:</strong></td>
            <td>
                @if(count($service_center->service_emails))
                    <ul>
                        @foreach($service_center->service_emails as $email)
                            <li>{{ $email->email }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ $user->email }}</p>
                @endif
            </td>
        </tr>
    </table>

@endsection
