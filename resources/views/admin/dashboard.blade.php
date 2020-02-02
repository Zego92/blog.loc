@extends('layouts.back.app')

@section('title', 'Панель Управления')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Главная</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">library_books</i>
                    </div>
                    <div class="content">
                        <div class="text">Всего Записей</div>
                        <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">favorite</i>
                    </div>
                    <div class="content">
                        <div class="text">Избранные</div>
                        <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favorite_posts()->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">library_books</i>
                    </div>
                    <div class="content">
                        <div class="text">Опубликованные</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_pending_posts }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">visibility</i>
                    </div>
                    <div class="content">
                        <div class="text">Просмотры</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_views }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="content">
                        <div class="text">Категории</div>
                        <div class="number count-to" data-from="0" data-to="{{ $category_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-blue-grey hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">labels</i>
                    </div>
                    <div class="content">
                        <div class="text">Теги</div>
                        <div class="number count-to" data-from="0" data-to="{{ $tag_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="content">
                        <div class="text">Пользователи</div>
                        <div class="number count-to" data-from="0" data-to="{{ $author_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-deep-orange hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">fiber_new</i>
                    </div>
                    <div class="content">
                        <div class="text">Пользователи за день</div>
                        <div class="number count-to" data-from="0" data-to="{{ $new_author_today }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Наиболее Популярные</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Насзвание</th>
                                        <th>Просмотры</th>
                                        <th>Избранные</th>
                                        <th>Комментарии</th>
                                        <th>Статус</th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($popular_posts as $key => $post)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ str_limit($post->title, '20') }}</td>
                                        <td>{{ $post->view_count }}</td>
                                        <td>{{ $post->favorite_to_users_count }}</td>
                                        <td>{{ $post->comments_count }}</td>
                                        <td>
                                            @if($post->status == true)
                                                <span class="label bg-green">Опубликовано</span>
                                            @else
                                                <span class="label bg-danger">Запрещено</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a target="_blank" class="btn btn-sm btn-info" href="{{ route('post.details', $post->slug) }}">Посмотреть</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot></tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <script src="{{ asset('/assets/back/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/raphael/raphael.min.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/morrisjs/morris.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/chartjs/Chart.bundle.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/flot-charts/jquery.flot.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/flot-charts/jquery.flot.resize.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/flot-charts/jquery.flot.pie.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/flot-charts/jquery.flot.categories.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    <script src="{{ asset('/assets/back/plugins/dropzone/dropzone.js') }}"></script>

    <script src="{{ asset('/assets/back/js/pages/index.js') }}"></script>

@endpush
