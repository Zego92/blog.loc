@extends('layouts.front.app')

@section('title','Категории')

@push('css')
    <link href="{{ asset('/assets/front/css/category/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/front/css/category/responsive.css') }}" rel="stylesheet">
    <style>
        .slider{
            background-image: url("{{ asset('/uploads/img/category/slider/' . $category->image) }}");
        }
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $category->name }}</b></h1>
    </div>

    <section class="blog-area section">
        <div class="container">
            <div class="row">
                @if($posts->count() > 0)
                    @forelse($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100">
                                <div class="single-post post-style-1">
                                    <div class="blog-image"><img src="{{ asset('/uploads/img/post/' . $post->image) }}" alt="{{ $post->title }}"></div>
                                    <div class="blog-info">
                                        <h4 class="title"><a href="{{ route('post.details',$post->slug) }}"><b>{{ $post->title }}</b></a></h4>
                                        <ul class="post-footer">
                                            <li>
                                                @guest
                                                    <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                        closeButton: true,
                                                        progressBar: true,
                                                    })"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                                @else
                                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                                       class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                                    <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none;">
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
                        </div>
                    @empty
                        <div class="col-lg-12 col-md-12">
                            <div class="card h-100">
                                <div class="single-post post-style-1 p-2">
                                    <strong>Записи не Найдены :(</strong>
                                </div>
                            </div>
                        </div>
                    @endforelse
                @else
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-info">
                                    <h4 class="title"><a href=""><b>Извините но в Данной Категории нет Постов</b></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
{{--            {{ $posts->links() }}--}}
        </div>
    </section>

@endsection

@push('js')

@endpush
