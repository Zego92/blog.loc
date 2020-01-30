@extends('layouts.front.app')

@section('title', 'Главная')

@push('css')
    <link href="{{ asset('/assets/front/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/front/css/responsive.css') }}" rel="stylesheet">
    <style>
        .favorite-posts{

        }
    </style>
@endpush

@section('content')
    <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
             data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
             data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">

            @foreach($categories as $category)

                <div class="swiper-slide">
                    <a class="slider-category" href="#">
                        <div class="blog-image">
{{--                            <img src="{{ asset('/assets/front/images/category-1-400x250.jpg') }}" alt="Blog Image">--}}
                            <img src="{{ asset('uploads/img/category/slider') }}/{{ $category->image }}" alt="{{ $category->name }}">
                        </div>
                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{ $category->name }}</b></h3>
                                </div>
                            </div>
                        </div>

                    </a>
                </div>

            @endforeach

            </div>
        </div>
    </div>
    <section class="blog-area section">
        <div class="container">
            <div class="row">

                @foreach($posts as $post)

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <div class="blog-image">
                                <img src="{{ asset('/uploads/img/post') }}/{{ $post->image }}" alt="{{ $post->title }}">
                            </div>
{{--                            <a class="avatar" href="{{ route('post.details', $post->slug) }}">--}}
{{--                                <img src="{{ asset('/uploads/img/profile') }}/{{ $post->user->image }}" alt="Profile Image">--}}
{{--                            </a>--}}
                            <div class="blog-info">
                                <h4 class="title">
                                    <a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a>
                                </h4>
                                <ul class="post-footer">
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
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
            <a class="load-more-btn" href="#"><b>Загрузить Еще</b></a>
        </div>
    </section>
@endsection

@push('js')

@endpush
