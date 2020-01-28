@extends('layouts.back.app')

@section('title', 'Добавление Нового Постами')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/back/plugins/bootstrap-select/css/bootstrap-select.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <form action="{{ route('adminpost.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" style="min-height: 250px;">
                        <div class="header">
                            <h3 style="font-weight: normal">
                                Добавление Нового Поста
                            </h3>
                        </div>
                        <div class="body">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="title" class="form-label">Название Поста</label>
                                        <input type="text" id="title" name="title" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="image" class="form-label"></label>
                                        <input type="file" id="image" name="image" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="checkbox" name="status" value="1" id="publish"  checked="">
                                        <label for="publish">Опубликовать</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Теги И Категории
                            </h2>
                        </div>
                        <div class="body" style="min-height: 230px;">
                            <div class="col-sm-6" style="margin: 25px 0;">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                    <label for="category">Выбирите Категорию</label>
                                    <select name="categories[]" id="category" class="form-control show-tick"
                                            data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6" style="margin: 25px 0;">
                                <div class="form-line {{ $errors->has('slider') ? 'focused error' : '' }}">
                                    <label for="tag">Выбирите Тег</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick"
                                            data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Описание
                            </h2>
                        </div>
                        <div class="body" style="min-height: 580px;">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea aria-label="" rows="4" class="form-control no-resize" name="body" id="tinymce" placeholder="ВВедите Текст........"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <a class="btn btn-danger m-t-15 waves-effect form-control" href="{{ route('adminpost.index') }}">Назад</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect form-control">Создать</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/assets/back/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('/assets/back/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = "{{ asset('/assets/back/plugins/tinymce/') }}";
        });
    </script>

@endpush

