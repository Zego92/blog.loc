@extends('layouts.front.app')

@section('title')
    {{ $post->title }}
@endsection

@push('css')
    <link href="{{ asset('/assets/front/css/post/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/front/css/post/responsive.css') }}" rel="stylesheet">
    <style>

        ion-icon {
            font-size: 22px;
        }
    </style>
@endpush

@section('content')
    <div class="slider" style="background-image: url('{{ asset('/uploads/img/post/' . $post->image) }}');">
        <div class="display-table  center-text">
            <h1 class="title display-table-cell"><b>{{ $post->title }}</b></h1>
        </div>
    </div>

    <section class="post-area section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 no-right-padding">
                    <div class="main-post">
                        <div class="blog-post-inner">
                            <div class="post-info">
                                <div class="middle-area">
{{--                                    <h6 class="date">Опубликован {{ $post->created_at->diffForHumans() }}</h6>--}}
                                    <h6 class="date">Опубликован {{ $post->created_at->diffForHumans() }}</h6>
                                </div>
                            </div>
                            <div class="post-image"><img src="{{ asset('/uploads/img/post/' . $post->image) }}" alt="{{ $post->title }}"></div>
                            <p class="para">{!! html_entity_decode($post->body) !!}</p>
                            <ul style="margin: 30px 0;">
                                @foreach($post->tags as $tag)
                                <li><a href="{{ route('tag.posts', $tag->slug) }}" class="btn btn-outline-info">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li>
                                    @guest
                                        <a href="javascript:void(0);" onclick="toastr.info('Для выполнения этого действия необходима авторизация', 'Внимание',{
                                                closeButton: true,
                                                progressBar: true,
                                            })"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                    @else
                                        <a class="{{ Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'favorite_posts' : '' }}" href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>

                                        <form id="favorite-form-{{ $post->id }}" method="post" action="{{ route('post.favorite', $post->id) }}" style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest
                                </li>
                                <li><a><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                <li><a><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>

                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12 no-left-padding">
                    <div class="single-post info-area">
                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>О Нас</b></h4>
                            <p>{{ $post->user->about }}</p>
                        </div>
                        <div class="sidebar-area subscribe-area">
                            <h4 class="title"><b>Подписаться</b></h4>
                            <div class="input-area">
                                <form action="{{ route('subscriber.store') }}" method="post">
                                    @csrf
                                    <input aria-label="" class="email-input" type="text" placeholder="Введите Ваш Email">
                                    <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="tag-area">
                            <h4 class="title"><b>Категория</b></h4>
                            <ul>
                                @foreach($post->categories as $tag)
                                <li><a href="{{ route('category.posts', $tag->slug) }}" class="btn btn-info">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($randomposts as $randompost)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <div class="blog-image"><img src="{{ asset('/uploads/img/post/' . $randompost->image) }}" alt="{{ $randompost->title }}"></div>
                            <div class="blog-info">
                                <h4 class="title"><a href="{{ route('post.details', $randompost->slug) }}"><b>{{ $randompost->title }}</b></a></h4>
                                <ul class="post-footer">
                                    <li>
                                        @guest
                                            <a href="javascript:void(0);" onclick="toastr.info('Для выполнения этого действия необходима авторизация', 'Внимание',{
                                                closeButton: true,
                                                progressBar: true,
                                            })"><i class="ion-heart"></i>{{ $randompost->favorite_to_users->count() }}</a>
                                        @else
                                            <a class="{{ Auth::user()->favorite_posts->where('pivot.post_id', $randompost->id)->count() == 0 ? 'favorite_posts' : '' }}" href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $randompost->id }}').submit();"><i class="ion-heart"></i>{{ $randompost->favorite_to_users->count() }}</a>

                                            <form id="favorite-form-{{ $randompost->id }}" method="post" action="{{ route('post.favorite', $randompost->id) }}" style="display: none;">
                                                @csrf
                                            </form>
                                        @endguest
                                    </li>
                                    <li><a><i class="ion-chatbubble"></i>{{ $randompost->comments->count() }}</a></li>
                                    <li><a><i class="ion-eye"></i>{{ $randompost->view_count }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>Комментарии</b></h4>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="comment-form">
                        @guest
                            <p class="text-center">Для добавления Комментариев необходимо <a class="btn btn-outline-danger" href="{{ route('login') }}">Авторизоваться</a></p>
                        @else
                        <form method="post" action="{{ route('comment.store', $post->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
									<textarea aria-label="" name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Напишите Комментарий" aria-required="true" aria-invalid="false"></textarea >
                                </div>
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>Добавить</b></button>
                                </div>
                            </div>
                        </form>
                        @endguest
                    </div>
                    <button type="button" class="btn btn-primary">
                        Комментриев <span class="badge badge-light">{{ $post->comments()->count() }}</span>
                    </button>
                    @if($post->comments->count() >= 0)
                        @foreach($post->comments as $comment)
                            <div class="commnets-area ">
                                <div class="comment">
                                    <div class="post-info">
                                        <div class="middle-area">
                                            <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                            <h6 class="date">{{ $comment->created_at->diffForHumans() }}</h6>
                                        </div>
                                    </div>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="comments-area">
                            <div class="comment">
                                <p>Комментариев Нет</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


@endsection

@push('js')
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
@endpush
