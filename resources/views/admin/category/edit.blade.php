@extends('layouts.back.app')

@section('title', 'Управление Категориями')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Форма Редактирования Категории
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admincategory.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
                                    <label for="name" class="form-label">Укажите имя Категории</label>
                                </div>
                                <div class="form-line">
                                    <label for="file"></label>
                                    <input type="file" name="image" id="file" value="{{ $category->image }}">
                                </div>
                            </div>
                            <br>
                            <div class="form-group float-right text-right">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Обновить</button>
                                <a href="{{ route('admincategory.index') }}" class="btn btn-danger m-t-15 waves-effect">Отменить</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush

