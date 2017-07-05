@extends('site.emails.layouts.master')

@section('content')

    <h3>Новая заявка со страницы Служба поддержки</h3>
    <hr>
    <h4>Данные клиента:</h4>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
            <td><strong>Имя:</strong></td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td><strong>Телефон:</strong></td>
            <td>{{ $phone }}</td>
        </tr>
        <tr>
            <td><strong>Сообщение:</strong></td>
            <td>{{ $comment }}</td>
        </tr>
    </table>

@endsection
