<header>
    <div class="container-fluid position-relative no-side-padding">
        <a href="#" class="logo"><img src="{{ asset('/assets/front/images/logo.png') }}" alt="Logo Image"></a>
        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="#">Категории</a></li>
            <li><a href="{{ route('login') }}">Авторизация</a></li>
            <li><a href="{{ route('register') }}">Регистрация</a></li>
        </ul>
        <div class="src-area">
            <form>
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input aria-label="" class="src-input" type="text" placeholder="Type of search">
            </form>
        </div>
    </div>
</header>
