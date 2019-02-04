@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp    
    <h4 class="font-weight-bold py-3 mb-4">Заказы<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h4>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Статус</th>
                <th>Оплата</th>
                <th class="text-right">{{--<a href="{{ route('orders::create') }}" class="btn btn-sm btn-outline-secondary">Новый заказ</a>--}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td>Заказ №{{ $order->site_order }} с сайта {{ $sites[$order->site_id]->name }}</td>
                    <td>@if ($order->order_type == 0)<a href="javascript:void(0)" class="badge badge-warning">Новый</a>@elseif($order->order_type == 1)<a href="javascript:void(0)" class="badge badge-primary">Принят</a>@elseif($order->order_type == 2)<a href="javascript:void(0)" class="badge badge-success">Выполнен</a>@else<a href="javascript:void(0)" class="badge badge-danger">Отменён</a>@endif</td>
                    <td>{!! (!empty($order->order_pay) ? '<a href="javascript:void(0)" class="badge badge-success">Оплачен</a>' : '<a href="javascript:void(0)" class="badge badge-secondary">Не оплачен</a>') !!}</td>
                    <td class="text-right"><a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-search d-block"></i></a> <a href="{{ route('orders::edit', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-create d-block"></i></a></td>
                </tr>                    
            @endforeach
        </tbody>
    </table>
</div>
@endsection