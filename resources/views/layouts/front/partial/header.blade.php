<header>
    <div class="container-fluid position-relative no-side-padding">
        <a href="{{ route('home') }}" class="logo"><img src="{{ asset('/assets/front/images/logo2.png') }}" alt="Logo Image"></a>
        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{ route('post.index') }}">Записи</a></li>
            <li><a data-toggle="modal" data-target="#exampleModal" style="cursor: pointer;">Категории</a></li>
            <li><a href="{{ route('contact') }}">Контакты</a></li>
            @guest
            <li><a href="{{ route('register') }}">Регистрация</a></li>
            <li><a href="{{ route('login') }}">Авторизация</a></li>
            @else
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
{{--            @foreach($categories as $category)--}}
{{--            <li id="cats" style="display: block;"><a style="display: block;" href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a></li>--}}
{{--            @endforeach--}}
        </ul>

        <div class="src-area">
            <form method="get" action="{{ route('search') }}">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input aria-label="" name="query" value="{{ isset($query) ? $query : '' }}" class="src-input" type="text" placeholder="Поиск">
            </form>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="right: 130%; left: -140%;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Категории</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            @foreach($categories as $category)
                            <a href="{{ route('category.posts', $category->slug) }}" class="list-group-item list-group-item-action">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
