@extends('site.emails.layouts.master')

@section('content')

    <h3>Исполнитель выставил ориентировочную дату завершение работы по Вашей заявке #{{ $user_request->r_id }} на услугу &laquo;{{ $user_request->services  }}&raquo;</h3>

    @if(!empty($user_request->deadline))
        <h3>Приблизительная дата завершение работы : {{ $user_request->deadline }}</h3>
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
            <td>{{ $user_request->cost_of_work_min }} - {{ $user_request->cost_of_work_max }} {{ ($user_request->exit_master == 1) ? '(Выезд мастера + 50грн)' : null }} </td>
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
            <td>{{ $user_request->exit_master ? 'Да' : 'Нет' }}</td>
        </tr>
        @if($user_request->exit_master == 1)
            <tr>
                <td><strong>Адрес клиента:</strong></td>
                <td>{{ $user_request->client_address }}</td>
            </tr>
        @endif
    </table>

@endsection
