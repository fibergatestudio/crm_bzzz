@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Валюты /</span> {{ (!empty($currency->id) ? 'Редактировать валюту' : 'Новая валюта') }}
    </h4>
    <div class="card mb-4">
        <h6 class="card-header">Данные о валюте</h6>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-dark-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Валюта успешно сохранена!
                </div>
            @endif
            <form action="{{ route('currencies::update') }}" method="post">
                <input type="hidden" name="id" id="id" value="{{ (!empty($currency->id) ? $currency->id : '0') }}">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="code">Код валюты</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="UAH" name="code" id="code" value="{{ (!empty($currency->code) ? $currency->code : '') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Название" name="name" id="name" value="{{ (!empty($currency->name) ? $currency->name : '') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="exchange_rate">Курс</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="30.0" name="exchange_rate" id="exchange_rate" value="{{ (!empty($currency->exchange_rate) ? $currency->exchange_rate : '') }}">
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