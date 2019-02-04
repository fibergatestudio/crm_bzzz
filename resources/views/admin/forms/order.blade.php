@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Заказы /</span> {{ (!empty($order->id) ? 'Редактировать заказ' : 'Новый заказ') }}
    </h4>
    <div class="card mb-4">
        <h6 class="card-header">Данные о заказе</h6>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-dark-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Заказ успешно сохранён!
                </div>
            @endif
            <form action="{{ route('orders::update') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="{{ (!empty($order->id) ? $order->id : '0') }}">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="client_id">Клиент</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="client_id" name="client_id">                            
                            <option value="{{ $order->client_id }}" selected disabled>{{ $client->tel }} ({{ $client->name }})</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="delivery_type">Тип доставки</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="delivery_type" name="delivery_type">                            
                            <option value="0"{{ (empty($order->delivery_type) ? ' selected' : '') }}>Самовывоз</option>
                            <option value="1"{{ (!empty($order->delivery_type) && ($order->delivery_type == 1) ? ' selected' : '') }}>Доставка по Киеву</option>
                            <option value="2"{{ (!empty($order->delivery_type) && ($order->delivery_type == 2) ? ' selected' : '') }}>Доставка Новой почтой</option>                            
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="order_type">Статус заказа</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="order_type" name="order_type">                            
                            <option value="0"{{ (empty($order->order_type) ? ' selected' : '') }}>Новый</option>
                            <option value="1"{{ (!empty($order->order_type) && ($order->order_type == 1) ? ' selected' : '') }}>Принят</option>
                            <option value="2"{{ (!empty($order->order_type) && ($order->order_type == 2) ? ' selected' : '') }}>Выполнен</option>
                            <option value="3"{{ (!empty($order->order_type) && ($order->order_type == 3) ? ' selected' : '') }}>Отменён</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="order_pay">Оплата заказа</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="order_pay" name="order_pay">                            
                            <option value="0"{{ (empty($order->order_pay) ? ' selected' : '') }}>Не оплачен</option>
                            <option value="1"{{ (!empty($order->order_pay) && ($order->order_pay == 1) ? ' selected' : '') }}>Оплачен</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="com">Комментарий к заказу</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="com" name="com" placeholder="Комментарий к заказу"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right"></label>
                    <div class="col-sm-10">
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
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection