@extends('layouts.back.app')

@section('title', 'Просмотр Поста')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <a href="{{ route('authorpost.index') }}" class="btn btn-danger waves-effect">Назад</a>
        @if($post->is_approved == false)
            <button type="button" class="btn btn-success pull-left"><i class="material-icons">done</i><span>Опубликовать</span></button>
        @else
            <button type="button" class="btn btn-success pull-right" disabled><i class="material-icons">done</i><span>Опубликовано</span></button>
        @endif
        <br>
        <br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card" style="min-height: 250px;">
                    <div class="header ">
                        <h3 style="font-weight: normal">
                            {{ $post->title }}
                            <br>
                            <small> Опубликова <strong>{{ $post->user->name }}</strong> {{ $post->created_at->toFormattedDateString() }} </small>
                        </h3>
                    </div>
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>Категории</h2>
                    </div>
                    <div class="body" style="min-height: 230px;">
                        @foreach($post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-green">
                        <h2>Теги</h2>
                    </div>
                    <div class="body" style="min-height: 230px;">
                        @foreach($post->tags as $tag)
                            <span class="label bg-green">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>Изображение</h2>
                    </div>
                    <div class="body" style="min-height: 230px;">
                        <img class="img-responsive thumbnail" src="{{ asset('uploads/img/post') }}/{{ $post->image }}" alt="">
{{--                        <img class="img-responsive thumbnail" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url('post/' . $post->image) }}" alt="">--}}
                    </div>
                </div>
            </div>
        </div>
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

