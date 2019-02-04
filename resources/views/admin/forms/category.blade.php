@extends('layouts.admin')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">    
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Категории /</span> {{ (!empty($category->id) ? 'Редактировать категорию' : 'Новая категория') }}
    </h4>
    <div class="card mb-4">
        <h6 class="card-header">Данные о категории</h6>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-dark-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Категория успешно сохранена!
                </div>
            @endif
            <form action="{{ route('categories::update') }}" method="post">
                <input type="hidden" name="id" id="id" value="{{ (!empty($category->id) ? $category->id : '0') }}">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Название категории" name="name" id="name" value="{{ (!empty($category->name) ? $category->name : '') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right" for="parent_id">Родительская категория</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="parent_id" name="parent_id">
                            <option value="0"{{ (empty($category->parent_id) ? ' selected' : '') }}>Нет</option>
                            @foreach ($categories as $subCategory1)
                                @if (empty($subCategory1->parent_id))
                                    <option value="{{ $subCategory1->id }}"{{ (!empty($category->parent_id) && ($category->parent_id == $subCategory1->id) ? ' selected' : '') }}>{{ $subCategory1->name }}</option>
                                    @foreach ($categories as $subCategory2)
                                        @if ($subCategory1->id == $subCategory2->parent_id)
                                            <option value="{{ $subCategory2->id }}"{{ (!empty($category->parent_id) && ($category->parent_id == $subCategory2->id) ? ' selected' : '') }}>— {{ $subCategory2->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
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