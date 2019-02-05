@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp    
    <h4 class="font-weight-bold py-3 mb-4">Отправки<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h4>
    <div class="alert alert-dark-success alert-dismissible fade show">Новая ТТН успешно создана!</div>
    <h4 class="font-weight-bold py-3 mb-4">Данные накладной</h4>
    <div class="card mb-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Статус</strong>: {{ $response['success'] }}</li>
            <li class="list-group-item"><strong>ID Новой почты</strong>: {{ $response['data'][0]['Ref'] }}</li>
            <li class="list-group-item"><strong>Цена доставки</strong>: {{ $response['data'][0]['CostOnSite'] }}</li>
            <li class="list-group-item"><strong>ТТН</strong>: {{ $response['data'][0]['IntDocNumber'] }}</li>
        </ul>
    </div>

    <b>Отправить смс</b>
    <form method="GET"  action="{{ route('sends::testsms') }}">
        @csrf

            <div class="form-group">
                <input type="hidden" name="ttn" value="{{ $response['data'][0]['IntDocNumber'] }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Номер телефона</label>
                <input type="number" name="number" placeholder="380971891270" class="form-control" required>
            </div>

        <button type="submit" class="btn btn-xl btn-outline-primary">Отправить</button>
        </div>
    </form>
</div>
@endsection