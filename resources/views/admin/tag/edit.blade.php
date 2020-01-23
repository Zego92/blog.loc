@extends('layouts.back.app')

@section('title', 'Управление Тегами')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        @if(Session::has('flash_message_error'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert"></button>
                <strong></strong>
            </div>
        @endif
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Форма Редактирования Тега
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admintag.update', $tag->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $tag->name }}">
                                    <label for="name" class="form-label">Укажите имя Тега</label>
                                </div>
                            </div>
                            <br>
                            <div class="form-group float-right text-right">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Обновить</button>
                                <a href="{{ route('admintag.index') }}" class="btn btn-danger m-t-15 waves-effect">Отменить</a>
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

