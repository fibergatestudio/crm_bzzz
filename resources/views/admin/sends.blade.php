@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp   

    <form method="GET"  action="{{ route('sends::np') }}">
        @csrf
        <p>ТНН создается по этим введенным данным (тест) и нажатием кнопку "добавить"</p>
        <p>ФИО - требует Имя-фамилию</p>
        <div class="row">
            <div class="form-group">
                <label>ФИО</label>
                <input type="text" name="fio" class="form-control" value="Имя Фамилия" placeholder="Имя Фамилия" required>
            </div>

            <div class="form-group">
                <label>Город</label>
                <input type="text" name="city" class="form-control" value="Киев" placeholder="Киев" required>
            </div>

            <div class="form-group">
                <label>Стоимость</label>
                <input type="number" name="cost" class="form-control" value="3200" placeholder="3200" required>
            </div>

        <button type="submit" class="btn btn-light">Добавить</button>
        </div>
    </form>



    <h4 class="font-weight-bold py-3 mb-4">Отправки<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h4>
    <a href="{{ route('sends::np') }}" class="btn btn-xl btn-outline-primary">Создать накладную</a> 
    <a href="{{ route('sends::sms') }}" class="btn btn-xl btn-outline-primary">Отправить SMS</a>
</div>
@endsection