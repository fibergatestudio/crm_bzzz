@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp    
    <h4 class="font-weight-bold py-3 mb-4">Заказ №{{ $order->site_order }} с сайта {{ $sites[$order->site_id]->name }}<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h4>
    <div class="card">
        <div class="card-header">Данные клиента</div>
        <table class="table card-table">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Телефон</th>
                    <th>ФИО</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $client->id }}</th>
                    <td>{{ $client->tel }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    @if (!empty($goods[0]->id))
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($goods as $good)
                    <tr>
                        <th scope="row">{{ $good->id }}</th>
                        <td>{!! (!empty($good->img) ? '<img src="/images/goods/' . $good->img . '_sm.jpg" height="50" />' : '') !!}</td>
                        <td>{{ $good->name }}</td>
                        <td>{{ $orderGoods[$good->id]->quantity }}</td>
                        <td>{{ $orderGoods[$good->id]->price }}</td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    @endif            
</div>
@endsection