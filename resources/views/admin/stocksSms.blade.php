@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp    
    <h4 class="font-weight-bold py-3 mb-4">Отправки<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h4>
    <div class="alert alert-dark-success alert-dismissible fade show">Новое сообщение успешно отправлено!</div>
    <h4 class="font-weight-bold py-3 mb-4">Последние сообщения</h4>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Телефон</th>
                <th>Сообщение</th>
                <th>Дата</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sms as $smsSingle)
                <tr>
                    <th scope="row">{{ $smsSingle->id }}</th>
                    <td>{{ $smsSingle->number }}</td>
                    <td>{{ $smsSingle->message }}</td>
                    <td>{{ $smsSingle->send_time }}</td>
                    <td>{{ $smsSingle->status }}</td>
                </tr>                    
            @endforeach
        </tbody>
    </table>
</div>
@endsection