@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    @php
    $monthes = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    $days = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье');
    @endphp    
    <h3 class="font-weight-bold py-3 mb-4">Добавления нового заказа по номеру телефону<hr style="border-top: 2px solid black; width: 60px;margin-left: 0px;"><div class="text-muted text-tiny mt-1"><small class="font-weight-normal">{{ $days[date('N')] }}, {{ date('d') }} {{ $monthes[date('n')] }} {{ date('Y') }}</small></div></h3>

    <div class="content">
        <div class="row">
            <div class="card card-outline-secondary">
                <!-- <div class="card-header">
                    <h3 class="mb-0">Добавление заказа</h3>
                </div> -->

                <div class="card-body">
                    <form class="form" action="{{ route('createneworder') }}" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{-- Айди Сайта --}}
                                    <input type="hidden" id="counter" name="site_id" value="1">

                                    <label>Информация о заказчике</label>
                                    <hr>
                                    <input type="text" name="name" class="form-control" placeholder="ФИО" required >
                                    <input type="text" name="tel" class="form-control" placeholder="Телефон" required >
                                    <input type="text" name="email" class="form-control" placeholder="E-mail" required >
                                    <select class="form-control" name="department_number" required>
                                        <?php 
                                                foreach($a['response'] as $warehouse){
                                                $city = $warehouse['city'];
                                                $address = $warehouse['address'];
                                                $ref = $warehouse['ref'];
                                                $number = $warehouse['number'] 
                                                // echo $address . "\r\n";
                                                ?>
                                                    <option value="<?= $ref ?>">Отделение №<?= $number ?> <b><?= $city ?></b> (<?= $address ?>)</option>
                                                <?php
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Список товаров</label>
                                    <hr>
                                    Артикул товара (тестовое значение 164 (Табак Лимон))
                                    <input type="text" name="good_id" class="form-control" value="164" required>
                                    <!-- <input type="date" name="new_brand" class="form-control"> -->
                                    <input type="text" name="new_brand" class="form-control" value="Табак Element Lemon (Лимон) - 100 грамм" required>
                                    <input type="number" name="quantity" class="form-control" placeholder="Количество" required>
                                    <input type="number" name="price" class="form-control" placeholder="Цена" required>
                                    <input type="number" name="new_brand" class="form-control" placeholder="Сумма">
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Информация о доставке и оплате</label>
                                    <hr>
                                    <label>Статус оплаты</label>
                                    <select class="form-control" id="order_pay" name="order_pay" required>                            
                                        <option value="0">Не оплачен</option>
                                        <option value="1">Оплачен</option>
                                    </select>
                                    <input type="text" name="new_model" class="form-control" placeholder="Способ доставки">
                                    <input type="text" name="com" class="form-control" placeholder="Комментарий менеджера" required>
                                    <select class="form-control" id="order_status" name="order_status" required>                            
                                        <option value="processed">Обработанный</option>
                                        <option value="unprocessed" selected>Необработанный</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        </div>
                        <div class="modal-footer">
                            <label>Общая сумма заказа</label>
                            <input type="text" name="new_model" class="form-control" value="3228" disabled>
                            <a href="{{ URL::previous() }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button></a>
                            <button type="submit" class="btn btn-success">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection