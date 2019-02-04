@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Товары /</span> {{ (!empty($good->id) ? 'Редактировать товар' : 'Новый товар') }}
    </h4>
    <div class="card mb-4">
        <h6 class="card-header">Данные о товаре</h6>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-dark-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Товар успешно сохранён!
                </div>
            @endif
            <form action="{{ route('goods::update') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="{{ (!empty($good->id) ? $good->id : '0') }}">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Название товара" name="name" id="name" value="{{ (!empty($good->name) ? $good->name : '') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="category_id">Категория</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach ($categories as $subCategory1)
                                @if (empty($subCategory1->parent_id))
                                    <option value="{{ $subCategory1->id }}"{{ (!empty($good->category_id) && ($good->category_id == $subCategory1->id) ? ' selected' : '') }}>{{ $subCategory1->name }}</option>
                                    @foreach ($categories as $subCategory2)
                                        @if ($subCategory1->id == $subCategory2->parent_id)
                                            <option value="{{ $subCategory2->id }}"{{ (!empty($good->category_id) && ($good->category_id == $subCategory2->id) ? ' selected' : '') }}>— {{ $subCategory2->name }}</option>
                                            @foreach ($categories as $subCategory3)
                                                @if ($subCategory2->id == $subCategory3->parent_id)
                                                    <option value="{{ $subCategory3->id }}"{{ (!empty($good->category_id) && ($good->category_id == $subCategory3->id) ? ' selected' : '') }}>—— {{ $subCategory3->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="price">Цена</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="0.00" name="price" id="price" value="{{ (!empty($good->price) ? $good->price : '') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="weight">Вес, грамм</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="100" name="weight" id="weight" value="{{ (!empty($good->weight) ? $good->weight : '') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="img">Фотография</label>
                    <div class="col-sm-10">
                        {!! (!empty($good->img) ? '<img src="/images/goods/' . $good->img . '_sm.jpg" /><br><br>' : '') !!}
                        <input name="img" id="img" type="file">
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