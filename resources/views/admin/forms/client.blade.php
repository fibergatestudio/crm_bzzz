@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Клиенты /</span> {{ (!empty($client->id) ? 'Редактировать клиента' : 'Новый клиент') }}
    </h4>
    <div class="card mb-4">
        <h6 class="card-header">Данные о клиенте</h6>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-dark-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Клиент успешно сохранён!
                </div>
            @endif
            <form action="{{ route('clients::update') }}" method="post">
                <input type="hidden" name="id" id="id" value="{{ (!empty($client->id) ? $client->id : '0') }}">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="tel">Телефон</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="380501112233" name="tel" id="tel" value="{{ (!empty($client->tel) ? $client->tel : '') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="name">ФИО</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Наименование поставщика" name="name" id="name" value="{{ (!empty($client->name) ? $client->name : '') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="email">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="mail@mail.ua" name="email" id="email" value="{{ (!empty($client->email) ? $client->email : '') }}">
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