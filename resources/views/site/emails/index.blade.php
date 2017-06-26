@extends('site.emails.layouts.master')

@section('content')

    <h3>Новая заявка #23232323 для сервисного центра &laquo; SASA &raquo;</h3>
    <hr>
    <h4>Данные клиента:</h4>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
            <td><strong>Имя:</strong></td>
            <td>Dima</td>
        </tr>
        <tr>
            <td><strong>Телефон:</strong></td>
            <td>093 514 7288</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>maldini2@ukr.net</td>
        </tr>
    </table>

    <h4>Информация о запросе:</h4>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
            <td><strong>Производитель устройства:</strong></td>
            <td>Lenovo</td>
        </tr>
        <tr>
            <td><strong>Услуга:</strong></td>
            <td>Ремонт екрана</td>
        </tr>
        <tr>
            <td><strong>Стоимость работы (ориентировочно):</strong></td>
            <td>230грн</td>
        </tr>
        <tr>
            <td><strong>Описание задачи:</strong></td>
            <td>Описание</td>
        </tr>
        <tr>
            <td><strong>Способ оплаты:</strong></td>
            <td>Наличные</td>
        </tr>
        <tr>
            <td><strong>Выезд мастера:</strong></td>
            <td>Да</td>
        </tr>
    </table>

@endsection