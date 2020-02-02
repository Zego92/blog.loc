@extends('layouts.front.app')

@section('title', 'Контакты')

@push('css')
    <link href="{{ asset('/assets/front/css/auth/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/front/css/auth/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>Контакты</b></h1>
    </div>
    <section class="blog-area section">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="post-wrapper">
                        <div class="card">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d641.2419271894095!2d36.20830182926647!3d49.99321486088061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDnCsDU5JzM1LjYiTiAzNsKwMTInMzEuOSJF!5e0!3m2!1sru!2sua!4v1580637667694!5m2!1sru!2sua" width="100%" height="600px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-wrapper">
                        <div class="card">
                            <div class="card-title">
                                <h4>Наши Контакты</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"> <ion-icon name="map"></ion-icon> Украина, г.Харьков, ул.Малая-Панасовская 6/14</li>
                                    <li class="list-group-item"> <i class="fas fa-phone-alt"></i>+380671481800</li>
                                    <li class="list-group-item"> <i class="fas fa-phone-alt"></i>+380661481800</li>
                                    <li class="list-group-item"> <i class="fas fa-phone-alt"></i>+380638928197</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
