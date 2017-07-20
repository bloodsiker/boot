@extends('site.emails.layouts.master')

@section('content')

<h3>Новый комментарий #{{ $comment->id }} сервисному центру {{ $service_center->service_name }} </h3>
<hr>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td><strong>Имя:</strong></td>
        <td>{{ $comment->user_name }}</td>
    </tr>
    <tr>
        <td><strong>Модель устройства:</strong></td>
        <td>{{ $comment->device }}</td>
    </tr>
    <tr>
        <td><strong>Услуга:</strong></td>
        <td>{{ $comment->service }}</td>
    </tr>
    <tr>
        <td><strong>Номер услуги: </strong></td>
        <td>{{ $comment->service_number }}</td>
    </tr>
    <tr>
        <td><strong>Коментарий:</strong></td>
        <td>{{ $comment->text }}</td>
    </tr>
</table>
<h4>Рейтинг:</h4>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td><strong>Средний рейтинг:</strong></td>
        <td>{{ $comment->r_total_rating }}</td>
    </tr>
    <tr>
        <td><strong>Качество работ:</strong></td>
        <td>{{ $comment->r_quality_of_work }}</td>
    </tr>
    <tr>
        <td><strong>Соблюдение сроков:</strong></td>
        <td>{{ $comment->r_deadlines }}</td>
    </tr>
    <tr>
        <td><strong>Соблюдение стоимости:</strong></td>
        <td>{{ $comment->r_compliance_cost }}</td>
    </tr>
    <tr>
        <td><strong>Цена/качество:</strong></td>
        <td>{{ $comment->r_price_quality }}</td>
    </tr>
    <tr>
        <td><strong>Обслуживание:</strong></td>
        <td>{{ $comment->r_service }}</td>
    </tr>
</table>

@endsection