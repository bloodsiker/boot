<h3>Новая заявка #{{ $data['r_id'] }} для сервисного центра &laquo;{{ $service_center->service_name }}&raquo;</h3>
<hr>
<h4>Данные клиента:</h4>
<table border="1" cellpadding="5" cellspacing="0" width="700px">
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
<h4>Информация о запросе:</h4>
<table border="1" cellpadding="5" cellspacing="0" width="700px">
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
        <td>{{ $data['cost_of_work'] }}</td>
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
        <td>{{ $data['exit_master'] }}</td>
    </tr>
</table>
<br>
<hr>
<h4>Данные сервисного цента:</h4>
<table border="1" cellpadding="5" cellspacing="0" width="700px">
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

