@extends('layouts.front.app')

@section('title')
    {{ $post->title }}
@endsection

@push('css')
    <link href="{{ asset('/assets/front/css/post/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/front/css/post/responsive.css') }}" rel="stylesheet">
    <style>
        .header-bg{
            height: 400px;
            width: 100%;

            background-size: cover;
        }
        .favorite_posts{
            color: blue;
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
                            <div class="post-image"><img src="{{ asset('/uploads/img/post/' . $post->image) }}" alt="Blog Image"></div>
                            <p class="para">
                                {{ html_entity_decode($post->body) }}
                            </p>
                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                <li><button type="button" class="btn btn-outline-info text-dark">{{ $tag->name }}</button></li>
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
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>
                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
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
                                <li><button type="button" class="btn btn-info">{{ $tag->name }}</button></li>
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
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $randompost->view_count }}</a></li>
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
            <h4><b>POST COMMENT</b></h4>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        <form method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input aria-label="" type="text" aria-required="true" name="contact-form-name" class="form-control"
                                           placeholder="Enter your name" aria-invalid="true" required >
                                </div>
                                <div class="col-sm-6">
                                    <input aria-label="" type="email" aria-required="true" name="contact-form-email" class="form-control"
                                           placeholder="Enter your email" aria-invalid="true" required>
                                </div>

                                <div class="col-sm-12">
									<textarea aria-label="" name="contact-form-message" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div>
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4><b>COMMENTS(12)</b></h4>
                    <div class="commnets-area">
                        <div class="comment">
                            <div class="post-info">
                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                                </div>
                                <div class="middle-area">
                                    <a class="name" href="#"><b>Katy Liu</b></a>
                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                                </div>
                                <div class="right-area">
                                    <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                </div>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.
                                Lorem ipsum dolor sit amet,
                                consectetur
                                Ut enim ad minim veniam
                            </p>
                        </div>
                        <div class="comment">
                            <h5 class="reply-for">Reply for <a href="#"><b>Katy Lui</b></a></h5>
                            <div class="post-info">
                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                                </div>
                                <div class="middle-area">
                                    <a class="name" href="#"><b>Katy Liu</b></a>
                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                                </div>
                                <div class="right-area">
                                    <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                </div>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.
                                Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam
                            </p>
                        </div>
                    </div>
                    <div class="commnets-area ">
                        <div class="comment">
                            <div class="post-info">
                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                                </div>
                                <div class="middle-area">
                                    <a class="name" href="#"><b>Katy Liu</b></a>
                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                                </div>
                                <div class="right-area">
                                    <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                </div>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.
                                Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam
                            </p>
                        </div>
                    </div>
                    <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</b></a>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('js')

@endpush
