@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp    
    <h4 class="font-weight-bold py-3 mb-4">Валюты<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h4>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Код валюты</th>
                <th>Название</th>
                <th>Курс</th>
                <th class="text-right"><a href="{{ route('clients::create') }}" class="btn btn-sm btn-outline-secondary">Новая валюта</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($currencies as $currency)
                <tr>
                    <th scope="row">{{ $currency->id }}</th>
                    <td>{{ $currency->code }}</td>
                    <td>{{ $currency->name }}</td>
                    <td>{{ $currency->exchange_rate }}</td>
                    <td class="text-right"><a href="{{ route('currencies::edit', ['id' => $currency->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-create d-block"></i></a></td>
                </tr>                    
            @endforeach
        </tbody>
    </table>
</div>
@endsection