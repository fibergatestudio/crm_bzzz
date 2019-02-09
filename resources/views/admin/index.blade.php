@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp
    <h4 class="font-weight-bold py-3 mb-4">Панель управления<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h4>
    <div class="row">
        <div class="card col-md-3" style="max-width: 20rem;">
            <button style="color:#27caff;" class="btn-light btn-lg text-left row">ЗАКАЗЫ</button>
            <div class="card-body">Необработанные заказы<br><h2><b style="color:#27caff;">{{ $unprocessed_orders }}</b></h2></div>
            <hr>
            <div class="card-body">Отменённые заказы<br>0</div> 
        </div>
        <div class="card col-md-3" style="max-width: 20rem;">
            <button style="color:#ae27ff;" class="btn-light btn-lg text-left row">ТОВАРЫ</button>
            <div class="card-body">Категорий<br><h2><b style="color:#ae27ff;">{{ $good_categories }}</b></h2></div>
            <hr>
            <div class="card-body">Товаров<br><h2><b style="color:#ae27ff;">{{ $goods }}</b></h2></div> 
        </div>
    </div>
</div>
@endsection