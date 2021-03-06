@extends('site.emails.layouts.master')

@section('content')

    <h3>Новая заявка #{{ $data['r_id'] }} для сервисного центра &laquo;{{ $service_center->service_name }}&raquo;</h3>
    <p>Зайдите, пожалуйста, в <a href="{{ route('service.login') }}">личный кабинет</a> сайта, раздел "Заявки" для просмотра деталей и принятия заявки в работу</p>
    <hr>
    <h4>Данные клиента:</h4>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
            <td><strong>Имя:</strong></td>
            <td>{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td><strong>Телефон:</strong></td>
            <td>{{ $data['phone'] }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $data['email'] }}</td>
        </tr>
    </table>
    <h4>Информация о заявке:</h4>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
            <td><strong>Производитель устройства:</strong></td>
            <td>{{ $data['manufacturer'] }}</td>
        </tr>
        <tr>
            <td><strong>Услуга:</strong></td>
            <td>{{ $data['services'] }}</td>
        </tr>
        <tr>
            <td><strong>Стоимость работы (ориентировочно):</strong></td>
            <td>{{ $data['cost_of_work_min'] }} - {{ $data['cost_of_work_max'] }} {{ ($data['exit_master'] == 1) ? '(Выезд мастера + 50грн)' : null }} </td>
        </tr>
        <tr>
            <td><strong>Описание задачи:</strong></td>
            <td>{{ $data['task_description'] }}</td>
        </tr>
        <tr>
            <td><strong>Способ оплаты:</strong></td>
            <td>{{ $data['payment_method'] }}</td>
        </tr>
        <tr>
            <td><strong>Выезд мастера:</strong></td>
            <td>{{ $data['exit_master'] == 1 ? 'Да' : 'Нет' }}</td>
        </tr>
        @if($data['exit_master'] == 1)
            <tr>
                <td><strong>Адрес клиента:</strong></td>
                <td>{{ $data['client_address'] }}</td>
            </tr>
        @endif
    </table>
    <br>
    <hr>
    <h4>Данные сервисного цента:</h4>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
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
