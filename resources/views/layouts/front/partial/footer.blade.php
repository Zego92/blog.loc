<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <a class="logo" href="#"><img src="{{ asset('/assets/front/images/logo.png') }}" alt="Logo Image"></a>
                    <p class="copyright">KRONA @ 2020. All rights reserved.</p>
                    <ul class="icons">
                        <li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="title"><b>Категории</b></h4>
                    <ul>
                        @foreach($categories as $category)

                        <li><a href="#">{{ $category->name }}</a></li>

                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">

                    <h4 class="title"><b>Подписаться</b></h4>
                    <div class="input-area">
                        <form action="{{ route('subscriber.store') }}" method="post">
                            @csrf
                            <input aria-label="" class="email-input" name="email" type="email" placeholder="Введите Ваш Email" required>
                            <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</footer>
