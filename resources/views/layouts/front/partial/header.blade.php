<header>
    <div class="container-fluid position-relative no-side-padding">
        <a href="{{ route('home') }}" class="logo"><img src="{{ asset('/assets/front/images/logo.png') }}" alt="Logo Image"></a>
        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('post.index') }}">Записи</a></li>
            <li><a href="#">Категории</a></li>
        </ul>
        <div class="src-area">
            <form>
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input aria-label="" class="src-input" type="text" placeholder="Поиск">
            </form>
        </div>
    </div>
</header>
