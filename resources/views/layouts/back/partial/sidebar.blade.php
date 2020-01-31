<aside id="leftsidebar" class="sidebar">
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('/assets/back/images/user.png') }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
        </div>
    </div>
    <div class="menu">
        <ul class="list">
            <li class="header">Навигация</li>
            @if(Request::is('admin/*'))
                <li class='{{ Request::is('admin/dashboard') ? "active" : '' }}'>
                    <a href="{{ route('admindashboard') }}">
                        <i class="material-icons text-success">dashboard</i>
                        <span>Главная</span>
                    </a>
                </li>
                {{ Request::is('admin/dashboard') ? '' : '' }}
                <li class="{{ Request::is('admin/tag*')  ? 'active' : ''}}">
                    <a href="{{ route('admintag.index') }}">
                        <i class="material-icons text-primary">label</i>
                        <span>Теги</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admincategory.index') }}">
                        <i class="material-icons text-info">view_module</i>
                        <span>Категории</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                    <a href="{{ route('adminpost.index') }}">
                        <i class="material-icons text-success">library_books</i>
                        <span>Записи</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/subscriber*') ? 'active' : '' }}">
                    <a href="{{ route('adminsubscriber.index') }}">
                        <i class="material-icons text-warning">supervisor_account</i>
                        <span>Подписчики</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/favorite*') ? 'active' : '' }}">
                    <a href="{{ route('adminfavorite.index') }}">
                        <i class="material-icons text-danger">favorite</i>
                        <span>Избранные</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/comment*') ? 'active' : '' }}">
                    <a href="{{ route('admincomment.index') }}">
                        <i class="material-icons text-success">comment</i>
                        <span>Комментарии</span>
                    </a>
                </li>
                <li class="header">Системные</li>
                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="{{ route('adminsettings') }}">
                        <i class="material-icons text-success">settings</i>
                        <span>Настройки</span>
                    </a>
                </li>
                <li class="">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons text-danger">input</i>
                        <span>{{ __('Выйти') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
            @if(Request::is('author*'))
                <li class="{{ Request::is('/author/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('authordashboard') }}">
                        <i class="material-icons text-success">dashboard</i>
                        <span>Главная</span>
                    </a>
                </li>
                <li class="{{ Request::is('/author/post*') ? 'active' : '' }}">
                    <a href="{{ route('authorpost.index') }}">
                        <i class="material-icons text-warning">library_books</i>
                        <span>Записи</span>
                    </a>
                </li>
                <li class="header">Системные</li>
                <li class="">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons text-danger">input</i>
                        <span>{{ __('Выйти') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif

        </ul>
    </div>
    <div class="legal">
        <div class="copyright">
            &copy; 2020 <a href="https://t.me/mirakle666" target="_blank">Genesis Codding</a>.
        </div>

    </div>
</aside>
