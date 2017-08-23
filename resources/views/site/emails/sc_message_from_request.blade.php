@extends('site.emails.layouts.master')

@section('content')

<h3>Для вас новое сообщение от сервисного центра по заявке #{{ $r_id }}</h3>
<p>{{ $data['message'] }}</p>
<hr>
<p>Что бы ответить на сообщение сервисного центра, перейдите в <a href="{{ route('user.login') }}">личный кабинет</a>,
    найдите заявку с номером #{{ $r_id }} и напишите ответ.</p>

@endsection