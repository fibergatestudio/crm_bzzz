@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp    
    <h3 class="font-weight-bold py-3 mb-4">ЗАКАЗЫ<hr style="border-top: 2px solid black; width: 60px;margin-left: 0px;"><div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h3>
    <div class="row">
        <div class="col-2">
            <ul class="nav">
                <a data-toggle="tab" href="#unprocessed"><button class="btn btn-danger btn-lg">{{ $unprocessed_orders }}<br> необработанных</button></a>
            </ul>
        </div>
        <div class="col-2 text-center">
            <a href="{{ route('neworder') }}"><button style="margin-top: 15px;" class="btn btn-info">Добавить новый заказ по телефону</button></a>
        </div>
    </div>
    <br>
    <div class="tab-content">
        <div id="unprocessed" class="tab-pane fade">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home"><button class="btn btn-light">Все заказы <b style="color:red;">({{ $unprocessed_orders }})</b></button></a></li>
                <li><a data-toggle="tab" href="#menu1" class="active show"><button class="btn btn-light">Курьерская доставка <b style="color:red;">({{ $courier_delivery }})</button></b></a></li>
                <li><a data-toggle="tab" href="#menu2"><button class="btn btn-light">Самовызов из магазина <b style="color:red;">({{ $pickup_delivery}})</button></b></a></li>
                <li><a data-toggle="tab" href="#menu3"><button class="btn btn-light">Наложенный платёж <b style="color:red;">({{ $cash_on_delivery }})</button></b></a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade active show">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>№ ЗАКАЗА</th>
                                <th>КОНТАКТНАЯ<br>ИНФОРМАЦИЯ</th>
                                <th>ДАТА</th>
                                <th>СУММА</th>
                                <th>СПОСОБ ОПЛАТЫ</th>
                                <th>СТАТУС ОПЛАТЫ</th>
                                <th>СТАТУС ЗАКАЗА</th>
                                <th>КОММЕНТАРИЙ МЕНЕДЖЕРА</th>
                                <th>МАГАЗИН</th>
                                <th class="text-right">{{--<a href="{{ route('orders::create') }}" class="btn btn-sm btn-outline-secondary">Новый заказ</a>--}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="text-center">
                                    <th scope="row">{{ $order->id }}<a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm"><i style="font-size:20px;" class="ion ion-ios-eye"></i></a></th>
                                    <th>{{ $order->client_tel }} <br>{{ $order->client_name }}</th>
                                    <th>{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</th>
                                    <th>{{ $order->client_sum }}</th>
                                    <th>
                                        @if ($order->payment_method == 0)
                                        Наличными при получении
                                        @elseif ($order->payment_method == 1)
                                        Наличными курьеру
                                        @else
                                        Перевод на карту Master Card/Visa
                                        @endif
                                        <br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></th>
                                    <td>{!! (!empty($order->order_pay) ? '<a href="javascript:void(0)" class="badge badge-success">Оплачен</a>' : '<a href="javascript:void(0)" class="badge badge-secondary">Не оплачен</a>') !!}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></td>
                                    <td>@if ($order->order_type == 0)<a href="javascript:void(0)" class="badge badge-warning">Новый</a>@elseif($order->order_type == 1)<a href="javascript:void(0)" class="badge badge-primary">Принят</a>@elseif($order->order_type == 2)<a href="javascript:void(0)" class="badge badge-success">Выполнен</a>@else<a href="javascript:void(0)" class="badge badge-danger">Отменён</a>@endif</td>
                                    <th>
                                    @if (!empty($order->com))
                                    {{ $order->com }}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a>
                                    @else
                                    Нету комментария {{ $order->com }}
                                    @endif
                                    </th>
                                    <th>{{ $sites[$order->site_id]->name }}</th>
                                    <td class="text-right"><a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-search d-block"></i></a> <a href="{{ route('orders::edit', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-create d-block"></i></a></td>
                                </tr>                    
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Пагинация --}}
                    <div class="row text-center">
                        <div style="margin-left: 50%;" class="text-xs-center">
                            <ul class="pagination">
                                @{{ $orders->links() }}                    
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>№ ЗАКАЗА</th>
                                <th>КОНТАКТНАЯ<br>ИНФОРМАЦИЯ</th>
                                <th>ДАТА</th>
                                <th>СУММА</th>
                                <th>СПОСОБ ОПЛАТЫ</th>
                                <th>СТАТУС ОПЛАТЫ</th>
                                <th>СТАТУС ЗАКАЗА</th>
                                <th>КОММЕНТАРИЙ МЕНЕДЖЕРА</th>
                                <th>МАГАЗИН</th>
                                <th class="text-right">{{--<a href="{{ route('orders::create') }}" class="btn btn-sm btn-outline-secondary">Новый заказ</a>--}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courier_delivery_orders as $order)
                                <tr class="text-center">
                                    <th scope="row">{{ $order->id }}<a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm"><i style="font-size:20px;" class="ion ion-ios-eye"></i></a></th>
                                    <th>{{ $order->client_tel }} <br>{{ $order->client_name }}</th>
                                    <th>{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</th>
                                    <th>{{ $order->client_sum }}</th>
                                    <th>способ оплаты<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></th>
                                    <td>{!! (!empty($order->order_pay) ? '<a href="javascript:void(0)" class="badge badge-success">Оплачен</a>' : '<a href="javascript:void(0)" class="badge badge-secondary">Не оплачен</a>') !!}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></td>
                                    <td>@if ($order->order_type == 0)<a href="javascript:void(0)" class="badge badge-warning">Новый</a>@elseif($order->order_type == 1)<a href="javascript:void(0)" class="badge badge-primary">Принят</a>@elseif($order->order_type == 2)<a href="javascript:void(0)" class="badge badge-success">Выполнен</a>@else<a href="javascript:void(0)" class="badge badge-danger">Отменён</a>@endif</td>
                                    <th>
                                    @if (!empty($order->com))
                                    {{ $order->com }}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a>
                                    @else
                                    Нету комментария{{ $order->com }}
                                    @endif
                                    </th>
                                    <th>{{ $sites[$order->site_id]->name }}</th>
                                    <td class="text-right"><a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-search d-block"></i></a> <a href="{{ route('orders::edit', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-create d-block"></i></a></td>
                                </tr>                    
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>№ ЗАКАЗА</th>
                                <th>КОНТАКТНАЯ<br>ИНФОРМАЦИЯ</th>
                                <th>ДАТА</th>
                                <th>СУММА</th>
                                <th>СПОСОБ ОПЛАТЫ</th>
                                <th>СТАТУС ОПЛАТЫ</th>
                                <th>СТАТУС ЗАКАЗА</th>
                                <th>КОММЕНТАРИЙ МЕНЕДЖЕРА</th>
                                <th>МАГАЗИН</th>
                                <th class="text-right">{{--<a href="{{ route('orders::create') }}" class="btn btn-sm btn-outline-secondary">Новый заказ</a>--}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pickup_delivery_orders as $order)
                                <tr class="text-center">
                                    <th scope="row">{{ $order->id }}<a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm"><i style="font-size:20px;" class="ion ion-ios-eye"></i></a></th>
                                    <th>{{ $order->client_tel }} <br>{{ $order->client_name }}</th>
                                    <th>{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</th>
                                    <th>{{ $order->client_sum }}</th>
                                    <th>способ оплаты<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></th>
                                    <td>{!! (!empty($order->order_pay) ? '<a href="javascript:void(0)" class="badge badge-success">Оплачен</a>' : '<a href="javascript:void(0)" class="badge badge-secondary">Не оплачен</a>') !!}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></td>
                                    <td>@if ($order->order_type == 0)<a href="javascript:void(0)" class="badge badge-warning">Новый</a>@elseif($order->order_type == 1)<a href="javascript:void(0)" class="badge badge-primary">Принят</a>@elseif($order->order_type == 2)<a href="javascript:void(0)" class="badge badge-success">Выполнен</a>@else<a href="javascript:void(0)" class="badge badge-danger">Отменён</a>@endif</td>
                                    <th>
                                    @if (!empty($order->com))
                                    {{ $order->com }}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a>
                                    @else
                                    Нету комментария{{ $order->com }}
                                    @endif
                                    </th>
                                    <th>{{ $sites[$order->site_id]->name }}</th>
                                    <td class="text-right"><a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-search d-block"></i></a> <a href="{{ route('orders::edit', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-create d-block"></i></a></td>
                                </tr>                    
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>№ ЗАКАЗА</th>
                                <th>КОНТАКТНАЯ<br>ИНФОРМАЦИЯ</th>
                                <th>ДАТА</th>
                                <th>СУММА</th>
                                <th>СПОСОБ ОПЛАТЫ</th>
                                <th>СТАТУС ОПЛАТЫ</th>
                                <th>СТАТУС ЗАКАЗА</th>
                                <th>КОММЕНТАРИЙ МЕНЕДЖЕРА</th>
                                <th>МАГАЗИН</th>
                                <th class="text-right">{{--<a href="{{ route('orders::create') }}" class="btn btn-sm btn-outline-secondary">Новый заказ</a>--}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cash_on_delivery_orders as $order)
                                <tr class="text-center">
                                    <th scope="row">{{ $order->id }}<a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm"><i style="font-size:20px;" class="ion ion-ios-eye"></i></a></th>
                                    <th>{{ $order->client_tel }} <br>{{ $order->client_name }}</th>
                                    <th>{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</th>
                                    <th>{{ $order->client_sum }}</th>
                                    <th>способ оплаты<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></th>
                                    <td>{!! (!empty($order->order_pay) ? '<a href="javascript:void(0)" class="badge badge-success">Оплачен</a>' : '<a href="javascript:void(0)" class="badge badge-secondary">Не оплачен</a>') !!}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></td>
                                    <td>@if ($order->order_type == 0)<a href="javascript:void(0)" class="badge badge-warning">Новый</a>@elseif($order->order_type == 1)<a href="javascript:void(0)" class="badge badge-primary">Принят</a>@elseif($order->order_type == 2)<a href="javascript:void(0)" class="badge badge-success">Выполнен</a>@else<a href="javascript:void(0)" class="badge badge-danger">Отменён</a>@endif</td>
                                    <th>
                                    @if (!empty($order->com))
                                    {{ $order->com }}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a>
                                    @else
                                    Нету комментария{{ $order->com }}
                                    @endif
                                    </th>
                                    <th>{{ $sites[$order->site_id]->name }}</th>
                                    <td class="text-right"><a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-search d-block"></i></a> <a href="{{ route('orders::edit', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-create d-block"></i></a></td>
                                </tr>                    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br>
    
    <div class="row">
        <div class="col-2">
            <ul class="nav">
                <a data-toggle="tab" href="#processed"><button class="btn btn-primary btn-lg">{{ $processed_orders }}<br> обработанных</button></a>
            </ul>
        </div>
    </div>
    <br>
    <div class="tab-content">
        <div id="processed" class="tab-pane fade">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#rdy0"><button class="btn btn-light">Все заказы <b style="color:#27caff;">({{ $processed_orders }})</b></button></a></li>
                <li><a data-toggle="tab" href="#rdy1" class="active show"><button class="btn btn-light">На сборке(27)</button></a></li> 
                <li><a data-toggle="tab" href="#rdy2"><button class="btn btn-light">Ожидает отправки(78)</button></a></li>
                <li><a data-toggle="tab" href="#rdy3"><button class="btn btn-light">В пути(27)</button></a></li>
                <li><a data-toggle="tab" href="#rdy4"><button class="btn btn-light">Доставлено(8)</button></a></li>
            </ul>

            <div class="tab-content">
                <div id="rdy0" class="tab-pane fade active show">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>№ ЗАКАЗА</th>
                                <th>КОНТАКТНАЯ<br>ИНФОРМАЦИЯ</th>
                                <th>ДАТА</th>
                                <th>СУММА</th>
                                <th>СПОСОБ ОПЛАТЫ</th>
                                <th>СТАТУС ЗАКАЗА</th>
                                <th>СТАТУС ДОСТАВКИ</th>
                                <th>КОММЕНТАРИЙ МЕНЕДЖЕРА</th>
                                <th>МАГАЗИН</th>
                                <th>ЗАКАЗ</th>
                                <th class="text-right">{{--<a href="{{ route('orders::create') }}" class="btn btn-sm btn-outline-secondary">Новый заказ</a>--}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proc_orders as $order)
                                <tr class="text-center">
                                    <th scope="row">{{ $order->id }}<a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm"><i style="font-size:20px;" class="ion ion-ios-eye"></i></a></th>                                    <th>{{ $order->client_tel }} <br>{{ $order->client_name }}</th>
                                    <th>{{ $order->created_at }}</th>
                                    <th>{{ $order->client_sum }}</th>
                                    <th>способ оплаты<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></th>
                                    <td>{!! (!empty($order->order_pay) ? '<a href="javascript:void(0)" class="badge badge-success">Оплачен</a>' : '<a href="javascript:void(0)" class="badge badge-secondary">Не оплачен</a>') !!}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></td>
                                    <td>@if ($order->order_type == 0)<a href="javascript:void(0)" class="badge badge-warning">Новый</a>@elseif($order->order_type == 1)<a href="javascript:void(0)" class="badge badge-primary">Принят</a>@elseif($order->order_type == 2)<a href="javascript:void(0)" class="badge badge-success">Выполнен</a>@else<a href="javascript:void(0)" class="badge badge-danger">Отменён</a>@endif<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a></td>
                                    <th>
                                    @if (!empty($order->com))
                                    {{ $order->com }}<br><a href="{{ route('orders::edit', ['id' => $order->id]) }}">изменить</a>
                                    @else
                                    Нету комментария{{ $order->com }}
                                    @endif
                                    </th>
                                    <th>{{ $sites[$order->site_id]->name }}</th>
                                    <th></th>
                                    <td class="text-right"><a href="{{ route('orders::read', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-search d-block"></i></a> <a href="{{ route('orders::edit', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-create d-block"></i></a></td>
                                </tr>                    
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Пагинация --}}
                    <div class="row text-center">
                        <div style="margin-left: 50%;" class="text-xs-center">
                            <ul class="pagination">
                                @{{ $orders->links() }}                    
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="rdy1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div id="rdy2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
                <div id="rdy3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
                <div id="rdy4" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
            </div>
        </div>
    </div> 
</div>

@endsection