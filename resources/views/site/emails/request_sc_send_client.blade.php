@extends('site.emails.layouts.master')

@section('content')

    <h3><b>{{ $data['name'] }}</b> Вы оставили заявку #{{ $data['r_id'] }} для сервисного центра &laquo;{{ $service_center->service_name }}&raquo;</h3>
    <p>Вы получите уведомление о принятии Вашей заявки на e-mail. <br>
        Также, Вы можете отслеживать все статусы Ваших заявок в <a href="{{route('user.login')}}">Личном Кабинете</a> сайта и вести переписку с Исполнителем.</p>
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

@endsection
