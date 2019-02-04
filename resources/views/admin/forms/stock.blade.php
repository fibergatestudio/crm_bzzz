@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Склады /</span> {{ (!empty($stock->id) ? 'Редактировать склад' : 'Новый склад') }}
    </h4>
    <div class="card mb-4">
        <h6 class="card-header">Данные о складе</h6>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-dark-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Склад успешно сохранён!
                </div>
            @endif
            <form action="{{ route('stocks::update') }}" method="post">
                <input type="hidden" name="id" id="id" value="{{ (!empty($stock->id) ? $stock->id : '0') }}">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Наименование склада" name="name" id="name" value="{{ (!empty($stock->name) ? $stock->name : '') }}">
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