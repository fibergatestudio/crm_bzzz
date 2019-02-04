@extends('layouts.admin')

@section('js')
<script>
$(document).ready(function() {
    $("#addMore").click(function() {
        $('.row-adding:last').clone().insertAfter(".row-adding:last");
        $('.good-select:last').val(0);
        $('.stock-select:last').val(1);
        $('.quantity-select:last').val(0);
    });
});
</script>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Приходы /</span> Новые поступления
    </h4>
    <div class="card mb-4">
        <h6 class="card-header">Данные о поступлении</h6>
        <div class="card-body">            
            <form action="{{ route('purchases::update') }}" method="post">
                <input type="hidden" name="id" id="id" value="1">
                <div class="form-row row-adding">
                    <div class="form-group col-md-6">
                        <label class="form-label">Товар</label>
                        <select class="custom-select good-select" name="goods[]">
                            <option value="0">Не выбран</option>
                            @foreach ($goods as $good)
                                <option value="{{ $good->id }}">{{ $good->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Склад</label>
                        <select class="custom-select stock-select" name="stocks[]">
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-label">Количество</label>
                        <input type="text" class="form-control quantity-select" name="quantity[]" value="0" placeholder="0">
                    </div>
                </div>
                <div class="form-row"><p style="margin-left: 0.5rem;"><a id="addMore" href="javascript:void(0);">Добавить ещё</a></p></div>                
                <button type="submit" class="btn btn-primary">Сохранить</button>            
            </form>
        </div>
    </div>
</div>
@endsection