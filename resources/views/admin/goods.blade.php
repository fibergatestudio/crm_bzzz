@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp    
    <h4 class="font-weight-bold py-3 mb-4">Товары<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h4>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Изображение</th>
                <th>Название</th>
                <th>Категория</th>
                <th class="text-right"><a href="{{ route('goods::create') }}" class="btn btn-sm btn-outline-secondary">Новый товар</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($goods as $good)
                <tr>
                    <th scope="row">{{ $good->id }}</th>
                    <td>{!! (!empty($good->img) ? '<img src="/images/goods/' . $good->img . '_sm.jpg" height="50" />' : '') !!}</td>
                    <td>{{ $good->name }}</td>
                    <td>{{ $categories[$good->category_id]->name }}</td>
                    <td class="text-right"><a href="{{ route('goods::edit', ['id' => $good->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="ion ion-md-create d-block"></i></a></td>
                </tr>                    
            @endforeach
        </tbody>
    </table>
    <div class="pull-right">
        {{ $goods->links() }}
    </div>
</div>
@endsection