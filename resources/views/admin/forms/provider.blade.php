@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Поставщики /</span> {{ (!empty($provider->id) ? 'Редактировать поставщика' : 'Новый поставщик') }}
    </h4>
    <div class="card mb-4">
        <h6 class="card-header">Данные о поставщике</h6>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-dark-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Поставщик успешно сохранён!
                </div>
            @endif
            <form action="{{ route('providers::update') }}" method="post">
                <input type="hidden" name="id" id="id" value="{{ (!empty($provider->id) ? $provider->id : '0') }}">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Наименование поставщика" name="name" id="name" value="{{ (!empty($provider->name) ? $provider->name : '') }}">
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